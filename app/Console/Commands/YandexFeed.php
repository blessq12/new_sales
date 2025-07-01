<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Yandex\YandexFeedService;

class YandexFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yandex:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Фиды для поисковой выдачи Яндекса';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Начинаем генерацию YML файла...');

        try {
            $service = new YandexFeedService();
            $service->generateFeed();

            $this->info('YML файл успешно сгенерирован в public/feeds/services.xml');
        } catch (\Exception $e) {
            $this->error('Ошибка при генерации файла: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
