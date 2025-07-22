<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Article;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $services = Service::where('name', 'like', '%' . $query . '%')->get();
        $services = $services->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'slug' => $service->slug,
                'description' => Str::limit(strip_tags($service->description), 35),
                'image' => '/uploads/' . $service->image,
                'url' => route('services.show', ['category' => $service->category->slug, 'slug' => $service->slug]),
            ];
        });
        return response()->json(['services' => $services]);
    }

    public function searchNews(Request $request)
    {
        $query = $request->input('q');
        $articles = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->active()
            ->latest()
            ->limit(5)
            ->get();

        $articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => Str::limit(strip_tags($article->content), 100),
                'image' => '/uploads/' . $article->cover_image,
                'url' => route('news.show', $article->slug),
                'category' => $article->category->name,
                'date' => $article->created_at->format('d.m.Y'),
            ];
        });

        return response()->json(['articles' => $articles]);
    }
}
