@extends('layouts.main')

@section('title', 'Новости')
@section('description', 'Последние новости и события')

@section('content')
    <x-hero-banner title="Новости" description="Будьте в курсе последних событий и новостей" :breadcrumbs="[['title' => 'Новости', 'url' => route('news.index')]]">
    </x-hero-banner>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 lg:py-16">
        @if ($featuredArticle)
            <!-- Топ-новость -->
            <div class="mb-16">
                <a href="{{ route('news.show', $featuredArticle->slug) }}" class="group">
                    <div class="relative rounded-3xl overflow-hidden bg-gray-900 shadow-2xl">
                        <div class="aspect-[21/9] relative">
                            <img src="{{ '/uploads/' . $featuredArticle->cover_image }}" alt="{{ $featuredArticle->title }}"
                                class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent">
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 lg:p-12">
                            <div class="relative">
                                <div class="flex items-center gap-4 mb-6">
                                    <span
                                        class="inline-flex items-center rounded-full bg-indigo-500/20 px-4 py-1 text-sm font-medium text-indigo-300 ring-1 ring-inset ring-indigo-500/30">
                                        {{ $featuredArticle->category->name }}
                                    </span>
                                    <div class="flex items-center gap-4 text-sm text-gray-400">
                                        <time datetime="{{ $featuredArticle->created_at->format('Y-m-d') }}"
                                            class="flex items-center">
                                            <span class="mdi mdi-calendar-blank mr-1"></span>
                                            {{ $featuredArticle->created_at->format('d.m.Y') }}
                                        </time>
                                        <span class="flex items-center">
                                            <span class="mdi mdi-eye mr-1"></span>
                                            {{ $featuredArticle->views_count }}
                                        </span>
                                    </div>
                                </div>
                                <h2
                                    class="text-4xl font-bold text-white mb-6 group-hover:text-indigo-300 transition-colors duration-200">
                                    {{ $featuredArticle->title }}
                                </h2>
                                <p class="text-lg text-gray-300 line-clamp-2">
                                    {{ Str::limit(strip_tags($featuredArticle->content), 200) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <div class="relative z-10 my-16">
            <div class="mx-auto max-w-7xl">
                <div class="rounded-2xl bg-white shadow-xl border border-gray-100 p-2">
                    <news-search></news-search>
                </div>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-900 mb-8">Свежие новости</h3>
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
            <div class="lg:col-span-8">
                <div class="grid gap-8">
                    @foreach ($latestArticles as $article)
                        <article
                            class="group relative bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-200">
                            <a href="{{ route('news.show', $article->slug) }}" class="flex flex-col md:flex-row">
                                <div class="md:w-72 relative">
                                    <div class="aspect-[4/3] md:aspect-[4/4]">
                                        <img src="{{ '/uploads/' . $article->cover_image }}" alt="{{ $article->title }}"
                                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                </div>
                                <div class="flex-1 p-6 lg:p-8">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-indigo-500/10 px-3 py-1 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-500/20">
                                            {{ $article->category->name }}
                                        </span>
                                        <div class="flex items-center gap-3 text-sm text-gray-500">
                                            <time datetime="{{ $article->created_at->format('Y-m-d') }}"
                                                class="flex items-center">
                                                <span class="mdi mdi-calendar-blank mr-1"></span>
                                                {{ $article->created_at->format('d.m.Y') }}
                                            </time>
                                            <span class="flex items-center">
                                                <span class="mdi mdi-eye mr-1"></span>
                                                {{ $article->views_count }}
                                            </span>
                                        </div>
                                    </div>
                                    <h4
                                        class="text-xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors duration-200">
                                        {{ $article->title }}
                                    </h4>
                                    <p class="text-gray-600 line-clamp-2 mb-4">
                                        {{ Str::limit(strip_tags($article->content), 150) }}
                                    </p>
                                    <span
                                        class="inline-flex items-center text-sm font-medium text-indigo-600 group-hover:text-indigo-500">
                                        Читать далее
                                        <span
                                            class="mdi mdi-arrow-right ml-1 transition-transform group-hover:translate-x-1"></span>
                                    </span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>

            <aside class="lg:col-span-4 mt-12 lg:mt-0">
                <div class="sticky top-8 space-y-8">

                    <div class="rounded-2xl bg-white p-8 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">
                            <span class="inline-flex items-center">
                                <span class="mdi mdi-folder-multiple-outline text-2xl text-indigo-600 mr-2"></span>
                                Категории
                            </span>
                        </h3>
                        <div class="space-y-2">
                            @foreach ($categories as $category)
                                <a href="{{ route('news.category', $category->slug) }}"
                                    class="group flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-all duration-200">
                                    <span class="text-gray-700 group-hover:text-indigo-600 font-medium">
                                        {{ $category->name }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100">
                                        {{ $category->articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Популярное за неделю -->
                    <div class="rounded-2xl bg-gradient-to-br from-gray-50 to-indigo-50/50 p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-8">
                            <span class="inline-flex items-center">
                                <span class="mdi mdi-trending-up text-2xl text-indigo-600 mr-2"></span>
                                Популярное за неделю
                            </span>
                        </h3>
                        <div class="space-y-6">
                            @foreach ($trendingArticles as $article)
                                <article class="group">
                                    <a href="{{ route('news.show', $article->slug) }}" class="block">
                                        <div class="flex gap-5">
                                            <div class="flex-shrink-0 w-24">
                                                <div class="aspect-square relative rounded-xl overflow-hidden">
                                                    <img src="{{ '/uploads/' . $article->cover_image }}"
                                                        alt="{{ $article->title }}"
                                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                        loading="lazy">
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                                                    {{ $article->title }}
                                                </h4>
                                                <div class="flex items-center gap-3 text-sm text-gray-500">
                                                    <span class="flex items-center">
                                                        <span class="mdi mdi-eye text-indigo-600 mr-1"></span>
                                                        {{ $article->views_count }}
                                                    </span>
                                                    <time datetime="{{ $article->created_at->format('Y-m-d') }}"
                                                        class="flex items-center">
                                                        <span class="mdi mdi-calendar-blank mr-1"></span>
                                                        {{ $article->created_at->format('d.m.Y') }}
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
