<?php

namespace App\Console\Commands\Raw;

use Illuminate\Console\Command;

class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raw:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение услуг из бд';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $services = \App\Models\Service::all();
        if ($services->count() > 0) {
            foreach ($services as $service) {
                $this->info('[SRV: ' . $service->id . '] ' . $service->name);
            }
        }
    }
}
