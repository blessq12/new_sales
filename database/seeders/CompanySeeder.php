<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name' => 'Салес',
            'description' => 'Услуги сантехника в Томске. Все виды сантехнических работ, любой сложности и объема.',
            'logo' => 'https://sales-tom.ru/wp-content/uploads/2024/09/logo-sales-tom.png',
            'addresses' => json_encode([
                'Иркутский проезд, 1, Октябрьский район, Томск 634003',
                'пл. Ленина, 6, Томск 634021'
            ]),
            'phones' => json_encode(['+7 (3822) 226-224', '+7 (906) 199-39-33']),
            'emails' => json_encode(['sales-tom@yandex.ru']),
            'website' => 'https://sales-tom.ru',
            'serviceAreas' => json_encode([
                'Кировский район',
                'Октябрьский район',
                'Ленинский район',
                'Академгородок',
                'Советский район'
            ]),
            'suburbs' => json_encode([
                'Тимирязево',
                'Зональный',
                'Черная речка',
                'Кисловка',
                'Дзержинское',
                'Зоркальцево',
                'Слобода Вольная',
                'Тахтамышево',
                'Кафтанчиково',
                'Лучаново',
                'Березкино',
                'Поросино',
                'Светлый',
                'Копылово',
                'Рассвет',
                'Воронино',
                'Корнилово',
                'Мирный',
                'Кузовлево',
                'Сосновый Бор',
                'Спутник',
                'Новомихайловка',
                'Лязгино',
                'Трубачево',
                'Позднеево',
                'Ключи',
                'Апрель',
                'Просторный',
                'Лоскутово',
                'Богашёво',
                'Синий Утёс',
                'Коларово'
            ]),
            'socials' => json_encode([
                'instagram' => [
                    'url' => 'https://www.instagram.com/sedoidead/',
                    'icon' => 'fab fa-instagram',
                    'title' => 'Instagram'
                ],
                'vk' => [
                    'url' => 'https://vk.com/santehniktomsksales',
                    'icon' => 'fab fa-vk',
                    'title' => 'ВКонтакте'
                ],
                'ok' => [
                    'url' => 'https://ok.ru/santehniktomsksales',
                    'icon' => 'fab fa-odnoklassniki',
                    'title' => 'Одноклассники'
                ],
                'youtube' => [
                    'url' => 'https://www.youtube.com/user/SedoiDead',
                    'icon' => 'fab fa-youtube',
                    'title' => 'YouTube'
                ],
                'facebook' => [
                    'url' => 'https://www.facebook.com/santehniktomsksales',
                    'icon' => 'fab fa-facebook',
                    'title' => 'Facebook'
                ],
                'twitter' => [
                    'url' => 'https://mobile.twitter.com/SedoiDead',
                    'icon' => 'fab fa-twitter',
                    'title' => 'Twitter'
                ]
            ]),
        ]);
    }
}
