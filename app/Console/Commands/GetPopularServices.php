<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Services\Telegram\TelegramMessageService;
use Illuminate\Console\Command;

class GetPopularServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-popular-services';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get popular services and send them to Telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $services = Service::orderBy('views', 'desc')
            ->take(10)
            ->get();

        if ($services->isEmpty()) {
            $this->error('No services found');
            return;
        }

        $message = ["🔥 Топ-10 популярных услуг:\n"];

        foreach ($services as $index => $service) {
            $message[] = ($index + 1) . ". {$service->name} - {$service->views} просмотров" . "\n" . route('services.show', ['category' => $service->category->slug, 'slug' => $service->slug]);
        }

        (new TelegramMessageService())->sendMessage($message, 'analytics');

        $this->info('Popular services list sent to Telegram');
    }
}
