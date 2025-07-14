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
        $articles = Article::with('category')
            ->active()
            ->latest()
            ->paginate(12);

        $categories = ArticleCategory::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('news.index', compact('articles', 'categories'));
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

        $articles = Article::whereIn('category_id', $categoryIds)
            ->active()
            ->latest()
            ->paginate(12);

        $categories = ArticleCategory::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('news.category', compact('articles', 'categories', 'category'));
    }

    /**
     * Показать отдельную статью
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Увеличиваем счетчик просмотров
        $article->incrementViews();

        // Получаем похожие статьи из той же категории
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->active()
            ->latest()
            ->limit(3)
            ->get();

        return view('news.show', compact('article', 'relatedArticles'));
    }
}
