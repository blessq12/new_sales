<?php

namespace App\Services\Yandex;

use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class YandexFeedService
{
    protected function addCData(SimpleXMLElement $element, string $text): void
    {
        $node = dom_import_simplexml($element);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($text));
    }

    public function generateFeed()
    {
        $company = Company::first();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog/>');
        $xml->addAttribute('date', date('Y-m-d H:i'));

        $shop = $xml->addChild('shop');

        // Основная информация о компании
        $shop->addChild('name', htmlspecialchars($company->name));
        $shop->addChild('company', htmlspecialchars($company->legal_name ?? $company->name));
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
            $cat = $categories->addChild('category', htmlspecialchars($category->name));
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
            $set->addChild('name', htmlspecialchars($category->name . ' в ' . ($company->city ?? 'вашем городе')));
            $set->addChild('url', route('services.category', ['category' => $category->slug]));
        }

        // Добавляем услуги
        $offers = $shop->addChild('offers');
        $services = Service::where('status', 'active')->with('category')->get();
        foreach ($services as $service) {
            $offer = $offers->addChild('offer');
            $offer->addAttribute('id', $service->id);

            // Основные поля
            $offer->addChild('name', htmlspecialchars($service->name));
            $offer->addChild('url', route('services.show', [
                'category' => $service->category->slug,
                'slug' => $service->slug
            ]));

            // Цена и валюта
            if ($service->price > 0) {
                $offer->addChild('price', $service->price);
                if ($service->price_type) {
                    $offer->addChild('sales_notes', 'за ' . $service->price_type);
                }
            } else {
                $offer->addChild('price', '0');
                $offer->addChild('sales_notes', 'цена договорная');
            }
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $service->category_id);

            // Привязка к сетам
            $offer->addChild('set-ids', 's' . $service->category_id);

            // Изображение
            if ($service->image) {
                $offer->addChild('picture', config('app.url') . '/uploads/' . $service->image);
            }

            // Описание
            if ($service->description) {
                $description = $offer->addChild('description');
                $this->addCData($description, strip_tags($service->description));
            }

            // Дополнительные параметры
            $offer->addChild('adult', 'false');
            $offer->addChild('expiry', 'P5Y');

            // Обязательные параметры
            $this->addParam($offer, 'Рейтинг', $service->rating ?? '5.0');
            $this->addParam($offer, 'Число отзывов', $service->reviews_count ?? '0');
            $this->addParam($offer, 'Годы опыта', $service->experience_years ?? '1');
            $this->addParam($offer, 'Регион', $company->city ?? 'Москва');
            $this->addParam($offer, 'Конверсия', '1.0');

            // Необязательные параметры
            $this->addParam($offer, 'Выезд на дом', $service->home_service ? 'да' : 'нет');
            $this->addParam($offer, 'Работа по договору', 'да');
            $this->addParam($offer, 'Наличный расчет', 'да');
            $this->addParam($offer, 'Безналичный расчет', 'да');
        }

        // Создаём директорию если её нет
        if (!file_exists(public_path('feeds'))) {
            mkdir(public_path('feeds'), 0755, true);
        }

        // Сохраняем XML в файл
        $xml->asXML(public_path('feeds/services.xml'));

        return true;
    }

    protected function addParam(SimpleXMLElement $offer, string $name, string $value): void
    {
        $param = $offer->addChild('param', htmlspecialchars($value));
        $param->addAttribute('name', $name);
    }
}
