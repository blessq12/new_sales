<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Company;
use SimpleXMLElement;
use DOMDocument;

class GenerateExcel extends Command
{
    protected $signature = 'yandex:services';
    protected $description = 'Генерация YML файла с услугами для выгрузки в Яндекс.Бизнес';

    protected function formatXML(SimpleXMLElement $xml): string
    {
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        return $dom->saveXML();
    }

    protected function cleanText(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return htmlspecialchars(trim($text), ENT_QUOTES | ENT_XML1, 'UTF-8');
    }

    public function handle()
    {
        $this->info('Начинаем генерацию YML файла...');

        try {
            $path = public_path('xlsx/');
            if (!file_exists($path)) {
                $this->info('Создание директории xlsx');
                mkdir($path, 0777, true);
            }

            $path = $path . 'services.xml';
            if (file_exists($path)) {
                $this->info('Удаление старого файла');
                unlink($path);
            }

            $xml = new SimpleXMLElement(file_get_contents(public_path('feeds/services.xml')));
            $shop = $xml->shop;

            unset($shop->categories);
            unset($shop->offers);

            // Добавляем категории
            $categories = $shop->addChild('categories');
            $dbCategories = ServiceCategory::where('status', true)->get();
            foreach ($dbCategories as $category) {
                $cat = $categories->addChild('category', $this->cleanText($category->name));
                $cat->addAttribute('id', $category->id);
                if ($category->parent_id) {
                    $cat->addAttribute('parentId', $category->parent_id);
                }
            }

            // Добавляем услуги
            $offers = $shop->addChild('offers');
            $services = Service::where('status', 'active')->with('category')->get();
            foreach ($services as $service) {
                $offer = $offers->addChild('offer');
                $offer->addAttribute('id', $service->id);

                $offer->addChild('name', $this->cleanText($service->name));
                if ($service->description) {
                    $offer->addChild('description', $this->cleanText($service->description));
                }
                $offer->addChild('shortDescription', $this->cleanText(mb_substr($service->description, 0, 200) . '...'));

                // Цена
                if ($service->price > 0) {
                    $offer->addChild('price', $service->price);
                } else {
                    $offer->addChild('price', '0');
                }
                $offer->addChild('currencyId', 'RUR');
                $offer->addChild('categoryId', $service->category->id);

                // Изображение
                if ($service->image) {
                    $offer->addChild('picture', config('app.url') . '/uploads/' . $service->image);
                }

                // URL
                $offer->addChild('url', route('services.show', [
                    'category' => $service->category->slug,
                    'slug' => $service->slug
                ]));
            }

            // Форматируем и сохраняем XML в файл
            file_put_contents($path, $this->formatXML($xml));
            $this->info('YML файл успешно сгенерирован в ' . $path);
        } catch (\Exception $e) {
            $this->error('Ошибка при генерации файла: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
