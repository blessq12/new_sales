<?php


use Illuminate\Support\Facades\Schedule;

Schedule::command('app:sitemap-generate')->dailyAt('00:00');
Schedule::command('app:yandex-feed')->dailyAt('00:00');
Schedule::call(function () {
    $data = (new \App\Services\Yandex\YandexMetrikaService())->getMetrics('sales');
    if (isset($data->error)) {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessage([
            '🚨 Ошибка при получении данных из Яндекса: ',
            '```' . $data->error . '```',
        ], 'error');
        \Log::error($data->error);
    } else {
        (new \App\Services\Telegram\TelegramMessageService())->sendMessage(
            [
                '🗓️ Статистика на: ' . $data->date . "\n",
                '👥 Посетителей: ' . $data->visits,
                '👤 Пользователей: ' . $data->users,
                '👀 Просмотров: ' . $data->pageviews,
                '🕒 Среднее время на сайте(минуты): ' . $data->avg_time_on_site,
                '🔍 Глубина просмотра: ' . $data->page_depth,
                '↪️ Процент отказа: ' . $data->bounce_rate,
                '<b>Источники:</b> ' . "\n",
                '➡️ Прямые: ' . $data->sources['direct'],
                '🔍 Поиск: ' . $data->sources['search'],
                '👥 Социальные: ' . $data->sources['social'],
            ],
            'analytics'
        );
    }
})->everyThreeHours();
