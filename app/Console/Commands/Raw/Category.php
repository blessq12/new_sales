<?php

namespace App\Console\Commands\Raw;

use Illuminate\Console\Command;

class Category extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raw:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение категорий из бд';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = \App\Models\ServiceCategory::all();
        if ($categories->count() > 0) {
            foreach ($categories as $category) {
                $this->info($category->name);
            }
        } else {
            $this->error('Категорий нет');
        }
    }
}
