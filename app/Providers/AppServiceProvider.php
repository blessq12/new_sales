<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SiteMapService;
use App\Services\QrCodeService;
use App\Services\Yandex\YandexFeedService;
use App\Services\Yandex\YandexDirectService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteMapService::class, fn() => new SiteMapService());
        $this->app->singleton(YandexFeedService::class, fn() => new YandexFeedService());
        $this->app->singleton(YandexDirectService::class, fn() => new YandexDirectService());
        $this->app->singleton(QrCodeService::class, fn() => new QrCodeService());

        \Illuminate\Support\Facades\View::composer('layouts.main', function ($view) {
            $view->with('company', \App\Models\Company::first());
        });
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
