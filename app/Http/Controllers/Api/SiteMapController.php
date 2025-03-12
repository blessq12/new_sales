<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Facades\SiteMap;
use Illuminate\Support\Facades\Storage;

class SiteMapController extends Controller
{
    /**
     * Генерация sitemap.xml
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     *
     * Для генерации sitemap.xml необходимо добавить URL и изображения в массив $urls
     * Методы для добавления URL и изображений в массив $urls:
     * addUrl($url, $lastmod, $changefreq, $priority, $images = [])
     * addImage($url, $title)
     *
     */

    public function generate()
    {
        $routes = [
            (object)['route' => route('main.index'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
            (object)['route' => route('main.about'), 'lastmod' => date('Y-m-d'), 'changefreq' => 'yearly', 'priority' => '1.0'],
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
                ['loc' => Storage::disk('uploads')->url($service->image), 'title' => $service->title]
            ]);
        }

        $result = SiteMap::generate();
        return response()->json(['message' => $result]);
    }
}
