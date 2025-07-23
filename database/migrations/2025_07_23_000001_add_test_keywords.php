<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Добавляем ключевые слова к первой категории
        DB::table('service_categories')
            ->where('id', 1)
            ->update([
                'keywords' => json_encode([
                    'услуги в москве',
                    'заказать услуги москва',
                    'профессиональные услуги',
                    'услуги недорого',
                    'качественные услуги'
                ]),
                'status' => 'active'
            ]);

        // Добавляем ключевые слова к первым двум услугам
        DB::table('services')
            ->whereIn('id', [1, 2])
            ->update([
                'keywords' => json_encode([
                    'заказать услугу',
                    'стоимость услуги',
                    'цена услуги',
                    'услуга под ключ',
                    'профессиональная услуга'
                ]),
                'status' => 'active'
            ]);
    }

    public function down()
    {
        DB::table('service_categories')
            ->where('id', 1)
            ->update([
                'keywords' => null,
                'status' => 'inactive'
            ]);

        DB::table('services')
            ->whereIn('id', [1, 2])
            ->update([
                'keywords' => null,
                'status' => 'inactive'
            ]);
    }
};
