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
            (object)['route' => route('main.certificates'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.contacts'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.privacy'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('main.gallery'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('main.agreement'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
            (object)['route' => route('services'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '1.0'],
        ];

        $services = \App\Models\Service::all();

        foreach ($routes as $route) {
            SiteMap::addUrl($route->route, $route->lastmod, $route->changefreq, $route->priority, []);
        }

        foreach ($services as $service) {
            SiteMap::addUrl(route('services.show', $service->slug), $service->updated_at, 'monthly', '0.8', [
                ['loc' => Storage::disk('uploads')->url($service->image), 'title' => $service->name]
            ]);
        }

        $result = SiteMap::generate();
        \Log::info('Sitemap generated');
    }
}
