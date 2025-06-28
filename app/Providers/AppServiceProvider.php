<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SiteMapService;
use App\Services\Yandex\YandexFeedService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('sitemap', function ($app) {
            return new SiteMapService();
        });
        $this->app->singleton('yandex-feed', function ($app) {
            return new YandexFeedService();
        });
        $this->app->alias('yandex-feed', YandexFeedService::class);
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
