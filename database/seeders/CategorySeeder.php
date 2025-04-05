<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Установка сантехники',
                'description' => 'Услуги по установке и замене сантехнического оборудования в ванной и на кухне.',
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Монтаж и замена систем водоснабжения',
                'description' => 'Работы по монтажу и замене труб, водосчетчиков и систем водоснабжения.',
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Отопление и теплоснабжение',
                'description' => 'Установка и обслуживание систем отопления, радиаторов и котлов.',
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Канализация и устранение засоров',
                'description' => 'Прочистка и монтаж канализационных систем.',
                'image' => 'https://via.placeholder.com/150',
            ],
            [
                'name' => 'Дополнительные работы',
                'description' => 'Сопутствующие услуги, такие как штробление стен под трубы.',
                'image' => 'https://via.placeholder.com/150',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\ServiceCategory::create($category);
        }
    }
}
