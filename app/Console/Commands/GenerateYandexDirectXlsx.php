<?php

namespace App\Console\Commands;

use App\Services\Yandex\YandexDirectService;
use Illuminate\Console\Command;

class GenerateYandexDirectXlsx extends Command
{
    protected $signature = 'yandex:direct-xlsx {output? : Путь для сохранения файла}';
    protected $description = 'Генерирует XLSX файл для Яндекс.Директ на основе услуг и категорий';

    public function handle(YandexDirectService $service)
    {
        $tempFile = $service->generateXlsx();

        $outputPath = $this->argument('output') ?? storage_path('app/yandex-direct.xlsx');

        rename($tempFile, $outputPath);

        $this->info("XLSX файл успешно сгенерирован: {$outputPath}");

        return Command::SUCCESS;
    }
}
