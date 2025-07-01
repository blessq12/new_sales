<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Company;
use SimpleXMLElement;

class GenerateExcel extends Command
{
    protected $signature = 'yandex:services';
    protected $description = 'Генерация YML файла с услугами для выгрузки в Яндекс.Бизнес';

    protected function addCData(SimpleXMLElement $element, string $text): void
    {
        $node = dom_import_simplexml($element);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($text));
    }

    public function handle()
    {
        $this->info('Начинаем генерацию YML файла...');

        try {
            $path = public_path('xlsx/');
            if (!file_exists($path)) {
                $this->info('Создание директории feeds');
                mkdir($path, 0777, true);
            }

            $path = $path . 'services.xml';
            if (file_exists($path)) {
                $this->info('Удаление старого файла');
                unlink($path);
            }

            $company = Company::first();
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog/>');
            $shop = $xml->addChild('shop');
            $this->info('Добавление категорий...');
            $categories = $shop->addChild('categories');
            $dbCategories = ServiceCategory::where('status', 'active')->get();
            foreach ($dbCategories as $category) {
                $cat = $categories->addChild('category', htmlspecialchars($category->name));
                $cat->addAttribute('id', $category->id);
            }
            $this->info('Добавление услуг...');
            $offers = $shop->addChild('offers');
            $services = Service::where('status', 'active')->with('category')->get();
            foreach ($services as $service) {
                $offer = $offers->addChild('offer');
                $offer->addAttribute('id', $service->id);
                $offer->addChild('name', htmlspecialchars($service->name));
                $offer->addChild('vendor', $company->name ?? 'Company Name');
                $offer->addChild('price', $service->price);
                $offer->addChild('currencyId', 'RUR');
                $offer->addChild('categoryId', $service->category_id);

                if ($service->image) {
                    $offer->addChild('picture', config('app.url') . '/uploads/' . $service->image);
                }

                if ($service->description) {
                    $description = $offer->addChild('description');
                    $this->addCData($description, strip_tags($service->description));

                    $shortDescription = $offer->addChild('shortDescription');
                    $this->addCData($shortDescription, mb_substr(strip_tags($service->description), 0, 100));
                }

                $offer->addChild('url', route('services.show', [
                    'category' => $service->category->slug,
                    'slug' => $service->slug
                ]));
            }

            $xml->asXML($path);
            $this->info('YML файл успешно сгенерирован в ' . $path);
        } catch (\Exception $e) {
            $this->error('Ошибка при генерации файла: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
