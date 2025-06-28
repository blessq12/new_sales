<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SiteMapService;
use App\Services\QrCodeService;
use App\Services\Yandex\YandexFeedService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteMapService::class, fn() => new SiteMapService());
        $this->app->singleton(YandexFeedService::class, fn() => new YandexFeedService());
        $this->app->singleton(QrCodeService::class, fn() => new QrCodeService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\ServiceCategory::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
            $category->status = 'inactive';
            $category->order = \App\Models\ServiceCategory::max('id') + 1;
        });
    }
}
