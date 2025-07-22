<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Показать список всех новостей
     */
    public function index()
    {
        // Получаем топ-новость (последняя активная)
        $featuredArticle = Article::with('category')
            ->active()
            ->latest()
            ->first();

        // Получаем свежие новости (исключая топ-новость)
        $latestArticles = Article::with('category')
            ->active()
            ->where('id', '!=', $featuredArticle?->id)
            ->latest()
            ->limit(5)
            ->get();

        // Получаем популярные новости за неделю
        $trendingArticles = Article::with('category')
            ->active()
            ->where('created_at', '>=', now()->subWeek())
            ->orderBy('views_count', 'desc')
            ->limit(4)
            ->get();

        // Получаем категории для фильтра
        $categories = ArticleCategory::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('news.index', compact('featuredArticle', 'latestArticles', 'trendingArticles', 'categories'));
    }

    /**
     * Показать новости определенной категории
     */
    public function category($slug)
    {
        $category = ArticleCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Получаем ID всех подкатегорий
        $categoryIds = [$category->id];
        $children = $category->allChildren()->get();
        foreach ($children as $child) {
            $categoryIds[] = $child->id;
        }

        $sort = request('sort', 'date_desc');

        $articlesQuery = Article::whereIn('category_id', $categoryIds)
            ->active();

        switch ($sort) {
            case 'date_asc':
                $articlesQuery->oldest();
                break;
            case 'popular':
                $articlesQuery->orderBy('views_count', 'desc');
                break;
            case 'date_desc':
            default:
                $articlesQuery->latest();
                break;
        }

        $articles = $articlesQuery->paginate(12);

        $categories = ArticleCategory::where('is_active', true)
            ->whereNull('parent_id')
            ->withCount('articles')
            ->with('children')
            ->get();

        return view('news.category', compact('articles', 'categories', 'category', 'sort'));
    }

    /**
     * Показать отдельную статью
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with('category')
            ->active()
            ->firstOrFail();

        // Увеличиваем счетчик просмотров
        $article->increment('views_count');

        // Получаем похожие статьи из той же категории
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->active()
            ->latest()
            ->limit(5)
            ->get();

        // Получаем релевантные услуги
        $suggestedServices = $article->suggestedServices()->get();

        return view('news.show', compact('article', 'relatedArticles', 'suggestedServices'));
    }
}
