@extends('layouts.main')

@section('title', $article->title)
@section('description', $article->description)
@section('og_image', '/uploads/' . $article->cover_image)

@section('content')
    <article itemscope itemtype="https://schema.org/Article">
        <x-hero-banner :title="$article->title" :description="$article->short_description" :breadcrumbs="[
            ['title' => 'Новости', 'url' => route('news.index')],
            ['title' => $article->category->name, 'url' => route('news.category', $article->category->slug)],
            ['title' => $article->title, 'url' => route('news.show', $article->slug)],
        ]">
        </x-hero-banner>

        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 lg:py-16">
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <!-- Основной контент -->
                <main class="lg:col-span-8">
                    <!-- Мета-информация -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-10">
                        <time datetime="{{ $article->created_at->format('Y-m-d') }}" itemprop="datePublished"
                            class="flex items-center">
                            <span class="mdi mdi-calendar-blank mr-1"></span>
                            {{ $article->created_at->format('d.m.Y') }}
                        </time>
                        <span class="flex items-center">
                            <span class="mdi mdi-eye mr-1"></span>
                            {{ $article->views_count }} просмотров
                        </span>
                        <a href="{{ route('news.category', $article->category->slug) }}"
                            class="inline-flex items-center rounded-xl bg-indigo-500/10 px-3 py-1.5 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-500/20 hover:bg-indigo-500/20 transition-colors duration-200">
                            <span class="mdi mdi-folder-outline mr-1"></span>
                            {{ $article->category->name }}
                        </a>
                    </div>

                    <!-- Главное изображение -->
                    <div class="relative rounded-2xl overflow-hidden mb-12 shadow-lg">
                        <div class="aspect-[16/9]">
                            <img src="{{ '/uploads/' . $article->cover_image }}" alt="{{ $article->title }}"
                                class="absolute inset-0 w-full h-full object-cover" itemprop="image">
                        </div>
                    </div>

                    <!-- Контент статьи -->
                    <div class="prose prose-lg max-w-none mb-16 prose-headings:font-semibold prose-headings:text-gray-900 prose-p:text-gray-600 prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl prose-strong:text-gray-900"
                        itemprop="articleBody">
                        {!! $article->content !!}
                    </div>

                    <!-- Шаринг -->
                    <div class="border-t border-gray-200 pt-10">
                        <h3 class="text-base font-semibold text-gray-900 mb-6">Поделиться статьей</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://vk.com/share.php?url={{ urlencode(request()->url()) }}" target="_blank"
                                rel="noopener"
                                class="inline-flex items-center rounded-xl bg-[#0077FF] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-opacity-90 transition-all duration-200">
                                <span class="mdi mdi-vk mr-2 text-lg"></span>
                                ВКонтакте
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}"
                                target="_blank" rel="noopener"
                                class="inline-flex items-center rounded-xl bg-[#26A5E4] px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-opacity-90 transition-all duration-200">
                                <span class="mdi mdi-telegram mr-2 text-lg"></span>
                                Telegram
                            </a>
                        </div>
                    </div>
                </main>

                <!-- Сайдбар -->
                <aside class="lg:col-span-4 mt-12 lg:mt-0">
                    <div class="sticky top-8 space-y-8">
                        <!-- Релевантные услуги -->
                        @if ($suggestedServices->count() > 0)
                            <div class="rounded-2xl bg-white p-8 shadow-lg border border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900 mb-6">Рекомендуемые услуги</h3>
                                <div class="space-y-8">
                                    @foreach ($suggestedServices as $service)
                                        <div class="group">
                                            <a href="{{ route('services.show', ['category' => $service->category->slug, 'slug' => $service->slug]) }}"
                                                class="block">
                                                <!-- Картинка -->
                                                <div class="relative rounded-2xl overflow-hidden mb-4">
                                                    <div class="aspect-[16/9]">
                                                        <img src="{{ '/uploads/' . $service->image }}"
                                                            alt="{{ $service->name }}"
                                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                            loading="lazy">
                                                    </div>
                                                    <!-- Градиент поверх картинки -->
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    </div>
                                                </div>

                                                <!-- Информация -->
                                                <div class="flex-1 min-w-0">
                                                    <h4
                                                        class="font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors duration-200 text-lg">
                                                        {{ $service->name }}
                                                    </h4>
                                                    <div class="flex items-center justify-between mb-3">
                                                        <div class="text-sm text-gray-500">
                                                            {{ $service->category->name }}
                                                        </div>
                                                        <div class="font-semibold text-indigo-600">
                                                            {{ number_format($service->price, 0, '.', ' ') }} ₽
                                                        </div>
                                                    </div>
                                                    <button
                                                        class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-500">
                                                        Заказать услугу
                                                        <span class="mdi mdi-arrow-right ml-2"></span>
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Похожие статьи -->
                        <div class="rounded-2xl bg-white p-8 shadow-lg border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Читайте также</h3>
                            <div class="space-y-6">
                                @foreach ($relatedArticles as $relatedArticle)
                                    <div class="group">
                                        <a href="{{ route('news.show', $relatedArticle->slug) }}" class="block">
                                            <div class="flex gap-5">
                                                <div class="flex-shrink-0 w-24">
                                                    <div class="aspect-square relative rounded-xl overflow-hidden">
                                                        <img src="{{ '/uploads/' . $relatedArticle->cover_image }}"
                                                            alt="{{ $relatedArticle->title }}"
                                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                                            loading="lazy">
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4
                                                        class="font-semibold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                                                        {{ $relatedArticle->title }}
                                                    </h4>
                                                    <div class="flex items-center gap-3 text-sm text-gray-500">
                                                        <time
                                                            datetime="{{ $relatedArticle->created_at->format('Y-m-d') }}">
                                                            {{ $relatedArticle->created_at->format('d.m.Y') }}
                                                        </time>
                                                        <span class="flex items-center">
                                                            <span class="mdi mdi-eye text-sm mr-1"></span>
                                                            {{ $relatedArticle->views_count }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Подписка на новости -->
                        <div class="rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 p-8 shadow-lg">
                            <h3 class="text-xl font-semibold text-white mb-3">Подписаться на новости</h3>
                            <p class="text-sm text-indigo-100 mb-6">Получайте самые интересные статьи на свою почту</p>
                            <form class="space-y-4">
                                <div>
                                    <input type="email" placeholder="Ваш email"
                                        class="block w-full rounded-xl border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <button type="submit"
                                    class="w-full rounded-xl bg-white px-4 py-3 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-colors duration-200">
                                    Подписаться
                                </button>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>
@endsection
