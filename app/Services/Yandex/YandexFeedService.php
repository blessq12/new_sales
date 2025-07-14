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

        // Добавляем сеты
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

            // Имя исполнителя вместо имени компании
            $offer->addChild('name', $this->cleanText($service->executor_name ?? $company->name));

            // Формируем URL с параметрами как в шаблоне
            $offer->addChild('url', route('services.show', [
                'category' => $service->category->slug,
                'slug' => $service->slug
            ]));

            // Цена и валюта
            $price = $offer->addChild('price', $service->price > 0 ? $service->price : '0');
            if ($service->price > 0 && $service->is_variable_price) {
                $price->addAttribute('from', 'true');
            }
            $offer->addChild('sales_notes', $service->price > 0 ? 'за ' . $this->cleanText($service->price_type ?? 'услугу') : 'цена договорная');
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $service->category_id);

            // Поддержка нескольких сетов, если нужно
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

            // Обязательные параметры
            $this->addParam($offer, 'рейтинг', $service->rating ?? '5.0');
            $this->addParam($offer, 'число отзывов', (string)$service->reviews()->count());
            $this->addParam($offer, 'годы опыта', $service->experience_years ?? '17');
            $this->addParam($offer, 'регион', $company->city ?? 'Томск');
            $this->addParam($offer, 'конверсия', $service->conversion ?? '0.7');

            // Необязательные параметры
            $this->addParam($offer, 'выезд на дом', $service->home_service ?? 'да');
            $this->addParam($offer, 'работа по адресу', $service->on_site_service ?? 'нет');
            $this->addParam($offer, 'выполняется удаленно', $service->remote_service ?? 'нет');
            $this->addParam($offer, 'проживание на объекте', $service->live_on_site ?? 'нет');
            $this->addParam($offer, 'бригада', $service->has_team ?? 'да');
            $this->addParam($offer, 'работа по договору', 'да');
            $this->addParam($offer, 'наличный расчет', 'да');
            $this->addParam($offer, 'безналичный расчет', 'да');
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
