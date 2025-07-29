<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Models\ArticleCategory;

class ListAllUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-all-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all website URLs including main pages, service categories, services, news categories and news';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating list of all website URLs...');
        $this->info('');

        // Main routes from web.php
        $this->info('=== Main Pages ===');
        $mainRoutes = [
            route('main.index'),
            route('main.about'),
            route('main.groheService'),
            route('main.contacts'),
            route('main.cooperation'),
            route('main.privacy'),
            route('main.gallery'),
            route('main.agreement'),
            route('services'),
            route('services.price'),
            route('news.index'),
            route('reviews.index'),
        ];

        foreach ($mainRoutes as $route) {
            $this->line($route);
        }

        // Service categories
        $this->info('');
        $this->info('=== Service Categories ===');
        $serviceCategories = ServiceCategory::all();
        foreach ($serviceCategories as $category) {
            $url = route('services.category', ['category' => $category->slug]);
            $this->line($url);
        }

        // Services
        $this->info('');
        $this->info('=== Services ===');
        $services = Service::all();
        foreach ($services as $service) {
            $url = route('services.show', [
                'slug' => $service->slug,
                'category' => $service->category->slug
            ]);
            $this->line($url);
        }

        // News categories
        $this->info('');
        $this->info('=== News Categories ===');
        $articleCategories = ArticleCategory::where('is_active', true)->get();
        foreach ($articleCategories as $category) {
            $url = route('news.category', [
                'slug' => $category->slug
            ]);
            $this->line($url);
        }

        // News articles
        $this->info('');
        $this->info('=== News Articles ===');
        $articles = Article::active()->get();
        foreach ($articles as $article) {
            $url = route('news.show', [
                'slug' => $article->slug
            ]);
            $this->line($url);
        }

        // Summary
        $this->info('');
        $this->info('=== Summary ===');
        $this->info('Main pages: ' . count($mainRoutes));
        $this->info('Service categories: ' . $serviceCategories->count());
        $this->info('Services: ' . $services->count());
        $this->info('News categories: ' . $articleCategories->count());
        $this->info('News articles: ' . $articles->count());
        $this->info('Total URLs: ' . (count($mainRoutes) + $serviceCategories->count() + $services->count() + $articleCategories->count() + $articles->count()));
    }
}
