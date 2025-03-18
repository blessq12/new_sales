<?php

namespace App\Providers;

use App\Facades\Telegram as FacadesTelegram;
use App\Models\Review;
use Illuminate\Support\ServiceProvider;
use App\Services\Telegram;
use App\Services\SiteMapService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('telegram', function ($app) {
            return new Telegram();
        });

        $this->app->singleton('sitemap', function ($app) {
            return new SiteMapService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Review::creating(function ($review) {
            FacadesTelegram::sendMessage([
                "Новый отзыв",
                "Имя: " . $review->name,
                "Сервис: " . \App\Models\Service::find($review->service_id)->name,
                "Рейтинг: " . $review->rating,
                "Сообщение: " . mb_strimwidth($review->message, 0, 20, "..."),
            ], 'success');
        });
    }
}
