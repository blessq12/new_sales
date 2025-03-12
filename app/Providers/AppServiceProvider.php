<?php

namespace App\Providers;

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
    }
}
