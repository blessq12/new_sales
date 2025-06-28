<?php

namespace App\Services\Yandex;

use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class YandexFeedService
{
    public function generateFeed()
    {
        $company = Company::first();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><yml_catalog/>');
        $xml->addAttribute('date', date('Y-m-d H:i'));

        $shop = $xml->addChild('shop');
        $shop->addChild('name', $company->name ?? 'Название компании');
        $shop->addChild('company', $company->legals()->first()->name ?? 'ООО Компания');
        $shop->addChild('url', config('app.url'));
        $shop->addChild('email', $company->emails[0] ?? 'info@company.ru');

        // Добавляем валюту
        $currencies = $shop->addChild('currencies');
        $currency = $currencies->addChild('currency');
        $currency->addAttribute('id', 'RUR');
        $currency->addAttribute('rate', '1');

        // Добавляем категории
        $categories = $shop->addChild('categories');
        $dbCategories = ServiceCategory::where('status', true)->get();
        Log::info('Categories count: ' . $dbCategories->count());
        foreach ($dbCategories as $category) {
            Log::info('Adding category: ' . $category->name . ' (ID: ' . $category->id . ')');
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
            $set->addChild('name', htmlspecialchars($category->name));
            $set->addChild('url', route('services.category', $category->slug));
        }

        // Добавляем услуги
        $offers = $shop->addChild('offers');
        $services = Service::where('status', 'active')->with('category')->get();
        Log::info('Services count: ' . $services->count());
        foreach ($services as $service) {
            Log::info('Adding service: ' . $service->name . ' (ID: ' . $service->id . ', Category ID: ' . $service->category_id . ')');
            $offer = $offers->addChild('offer');
            $offer->addAttribute('id', $service->id);
            $offer->addChild('name', htmlspecialchars($service->name));
            $offer->addChild('url', route('services.show', ['category' => $service->category->slug, 'slug' => $service->slug]));
            $offer->addChild('price', $service->price);
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $service->category_id);
            $offer->addChild('set-ids', 's' . $service->category_id);
            if ($service->description) {
                $offer->addChild('description', htmlspecialchars(strip_tags($service->description)));
            }
        }

        // Создаём директорию если её нет
        if (!file_exists(public_path('feeds'))) {
            mkdir(public_path('feeds'), 0755, true);
        }

        // Сохраняем XML в файл
        $xml->asXML(public_path('feeds/services.xml'));

        return response($xml->asXML(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'no-cache');
    }
}
