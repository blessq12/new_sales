<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Telegram;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
