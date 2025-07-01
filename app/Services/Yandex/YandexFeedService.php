<?php

namespace App\Services\Yandex;

use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Company;

use SimpleXMLElement;
use DOMDocument;

class YandexFeedService
{
    protected function formatXML(SimpleXMLElement $xml): string
    {
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        return $dom->saveXML();
    }

    protected function addCData(SimpleXMLElement $element, string $text): void
    {
        $node = dom_import_simplexml($element);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($text));
    }

    protected function cleanText(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return htmlspecialchars(trim($text), ENT_QUOTES | ENT_XML1, 'UTF-8');
    }

    public function generateFeed()
    {
        $company = Company::first();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog/>');
        $xml->addAttribute('date', date('Y-m-d H:i'));

        $shop = $xml->addChild('shop');

        // Основная информация о компании
        $shop->addChild('name', $this->cleanText($company->name));
        $shop->addChild('company', $this->cleanText($company->legal_name ?? $company->name));
        $shop->addChild('url', config('app.url'));
        $shop->addChild('email', $company->email);

        // Валюта
        $currencies = $shop->addChild('currencies');
        $currency = $currencies->addChild('currency');
        $currency->addAttribute('id', 'RUR');
        $currency->addAttribute('rate', '1');

        // Добавляем категории
        $categories = $shop->addChild('categories');
        $dbCategories = ServiceCategory::where('status', 'active')->get();
        foreach ($dbCategories as $category) {
            $cat = $categories->addChild('category', $this->cleanText($category->name));
            $cat->addAttribute('id', $category->id);
            if ($category->parent_id) {
                $cat->addAttribute('parentId', $category->parent_id);
            }
        }

        // Добавляем сеты (группы услуг)
        $sets = $shop->addChild('sets');
        foreach ($dbCategories as $category) {
            $set = $sets->addChild('set');
            $set->addAttribute('id', 's' . $category->id);
            $set->addChild('name', $this->cleanText($category->name . ' в ' . ($company->city ?? 'вашем городе')));
            $set->addChild('url', route('services.category', ['category' => $category->slug]));
        }

        // Добавляем услуги
        $offers = $shop->addChild('offers');
        $services = Service::where('status', 'active')->with('category')->get();
        foreach ($services as $service) {
            $offer = $offers->addChild('offer');
            $offer->addAttribute('id', $service->id);

            // Основные поля
            $offer->addChild('name', $this->cleanText($service->name));
            $offer->addChild('url', route('services.show', [
                'category' => $service->category->slug,
                'slug' => $service->slug
            ]));

            // Цена и валюта
            if ($service->price > 0) {
                $offer->addChild('price', $service->price);
                if ($service->price_type) {
                    $offer->addChild('sales_notes', 'за ' . $this->cleanText($service->price_type));
                }
            } else {
                $offer->addChild('price', '0');
                $offer->addChild('sales_notes', 'цена договорная');
            }
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $service->category_id);

            $offer->addChild('set-ids', 's' . $service->category_id);

            if ($service->image) {
                $offer->addChild('picture', config('app.url') . '/uploads/' . $service->image);
            }

            if ($service->description) {
                $description = $offer->addChild('description');
                $this->addCData($description, $this->cleanText($service->description));
            }

            $offer->addChild('adult', 'false');
            $offer->addChild('expiry', 'P5Y');

            // Обязательные параметры для Яндекс.Маркета
            $this->addParam($offer, 'Рейтинг',  5.0);
            $this->addParam($offer, 'Число отзывов', (string)$service->reviews()->count());
            $this->addParam($offer, 'Годы опыта', '17');
            $this->addParam($offer, 'Регион', $company->city ?? 'Томск');
            $this->addParam($offer, 'Конверсия', '0.7');

            // Дополнительные параметры
            $this->addParam($offer, 'Выезд на дом', $service->home_service ?? 'да');
            $this->addParam($offer, 'Работа по договору', 'да');
            $this->addParam($offer, 'Наличный расчет', 'да');
            $this->addParam($offer, 'Безналичный расчет', 'да');
        }

        if (!file_exists(public_path('feeds'))) {
            mkdir(public_path('feeds'), 0755, true);
        }

        file_put_contents(
            public_path('feeds/services.xml'),
            $this->formatXML($xml)
        );

        return true;
    }

    protected function addParam(SimpleXMLElement $offer, string $name, string $value): void
    {
        $param = $offer->addChild('param', $this->cleanText($value));
        $param->addAttribute('name', $name);
    }
}
