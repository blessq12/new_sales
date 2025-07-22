@extends('layouts.main')
@section('title', $category->name)
@section('description', $category->description)
@section('og_image', '/assets/images/banner.png')

@section('content')
    <x-hero-banner :title="$category->name" :description="$category->description" :breadcrumbs="[
        ['title' => 'Новости', 'url' => route('news.index')],
        ['title' => $category->name, 'url' => route('news.category', $category->slug)],
    ]">
    </x-hero-banner>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
        <div class="my-8 relative">
            <news-search></news-search>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            <!-- Основной контент -->
            <main class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($articles as $article)
                        <x-article-card :article="$article" />
                    @endforeach
                </div>

                @if ($articles->hasPages())
                    <div class="mt-12">
                        <div class="flex items-center justify-center gap-2">
                            {{ $articles->appends(['sort' => request('sort')])->links() }}
                        </div>
                    </div>
                @endif
            </main>

            <!-- Сайдбар -->
            <aside class="lg:col-span-4">
                <div class="sticky top-4 space-y-6">
                    <!-- Сортировка -->
                    <div class="rounded-2xl bg-white p-6 shadow-md">
                        <h3 class="text-base font-semibold text-gray-900 mb-4">Сортировка</h3>
                        <div class="space-y-2">
                            <a href="{{ route('news.category', ['slug' => $category->slug, 'sort' => 'date_desc']) }}"
                                class="block px-4 py-2 rounded-xl {{ $sort === 'date_desc' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                Сначала новые
                            </a>
                            <a href="{{ route('news.category', ['slug' => $category->slug, 'sort' => 'date_asc']) }}"
                                class="block px-4 py-2 rounded-xl {{ $sort === 'date_asc' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                Сначала старые
                            </a>
                            <a href="{{ route('news.category', ['slug' => $category->slug, 'sort' => 'popular']) }}"
                                class="block px-4 py-2 rounded-xl {{ $sort === 'popular' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                По популярности
                            </a>
                        </div>
                    </div>

                    <!-- Категории -->
                    <div class="rounded-2xl bg-white p-6 shadow-md">
                        <h3 class="text-base font-semibold text-gray-900 mb-4">Категории новостей</h3>
                        <div class="space-y-2">
                            @foreach ($categories as $cat)
                                <a href="{{ route('news.category', $cat->slug) }}"
                                    class="flex items-center justify-between px-4 py-2 rounded-xl {{ $cat->id === $category->id ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-sm text-gray-500">{{ $cat->articles_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
