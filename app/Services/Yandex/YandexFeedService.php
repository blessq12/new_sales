<?php

namespace App\Services\Yandex;

use App\Models\ServiceCategory;
use App\Models\Service;
use SimpleXMLElement;

class YandexFeedService
{
    public function generateFeed()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><yml_catalog/>');
        $xml->addAttribute('date', date('Y-m-d H:i'));

        $shop = $xml->addChild('shop');
        $shop->addChild('name', 'Название компании');
        $shop->addChild('company', 'ООО Компания');
        $shop->addChild('url', config('app.url'));
        $shop->addChild('email', 'info@company.ru');

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

        // Добавляем услуги
        $offers = $shop->addChild('offers');
        $services = Service::where('status', 'active')->get();
        foreach ($services as $service) {
            $offer = $offers->addChild('offer');
            $offer->addAttribute('id', $service->id);
            $offer->addChild('name', htmlspecialchars($service->name));
            $offer->addChild('url', route('services.show', ['category' => $service->category->slug, 'slug' => $service->slug]));
            $offer->addChild('price', $service->price);
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $service->category_id);
            if ($service->description) {
                $offer->addChild('description', htmlspecialchars($service->description));
            }
        }

        // Создаём директорию если её нет
        if (!file_exists(public_path('feeds'))) {
            mkdir(public_path('feeds'), 0755, true);
        }

        $xml->asXML(public_path('feeds/services.xml'));

        return "ok";
        // return response($xml->asXML(), 200)
        //     ->header('Content-Type', 'application/xml')
        //     ->header('Cache-Control', 'no-cache');
    }
}
