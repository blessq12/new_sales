<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\SiteMap;
use Illuminate\Support\Facades\Storage;

class SitemapGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sitemap-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = [
            (object)['route' => route('main.index'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.about'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.cooperation'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('main.groheService'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.contacts'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.privacy'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('main.gallery'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('main.agreement'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('services'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('services.price'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('news.index'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'daily', 'priority' => '0.9'],
        ];

        $services = \App\Models\Service::all();
        $articles = \App\Models\Article::active()->get();
        $articleCategories = \App\Models\ArticleCategory::where('is_active', true)->get();

        foreach ($routes as $route) {
            SiteMap::addUrl($route->route, $route->lastmod, $route->changefreq, $route->priority, []);
        }

        foreach ($services as $service) {
            SiteMap::addUrl(route('services.show', [
                'slug' => $service->slug,
                'category' => $service->category->slug
            ]), $service->updated_at, 'monthly', '0.8', [
                ['loc' => env('APP_URL') . '/uploads/' . $service->image, 'title' => $service->name]
            ]);
        }

        // Добавляем категории новостей
        foreach ($articleCategories as $category) {
            SiteMap::addUrl(route('news.category', [
                'slug' => $category->slug
            ]), $category->updated_at, 'weekly', '0.7', []);
        }

        // Добавляем статьи
        foreach ($articles as $article) {
            $images = [];
            if ($article->cover_image) {
                $images[] = ['loc' => '/uploads/' . $article->cover_image, 'title' => $article->title];
            }

            SiteMap::addUrl(route('news.show', [
                'slug' => $article->slug
            ]), $article->published_at, 'weekly', '0.6', $images);
        }

        $result = SiteMap::generate();
        $this->info('Sitemap generated');
        (new \App\Services\Telegram\TelegramMessageService())->sendMessage([
            '🗂️ Сгенерирован сайтмап',
            "",
            'Количество услуг: ' . $services->count(),
            'Количество статей: ' . $articles->count(),
            'Количество категорий статей: ' . $articleCategories->count(),
            "",
            '🔗 Ссылка: ' . env('APP_URL') . '/sitemap.xml',
        ], 'event');
    }
}
