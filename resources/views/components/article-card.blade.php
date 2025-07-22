<div class="group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:shadow-xl"
    itemscope itemtype="https://schema.org/Article">
    <!-- Изображение с эффектом масштабирования при наведении -->
    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
        <img src="{{ '/uploads/' . $article->cover_image }}" alt="{{ $article->title }}"
            class="h-48 w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
            itemprop="image" loading="lazy">
    </div>

    <!-- Контент -->
    <div class="p-6">
        <div class="min-h-[140px]">
            <!-- Категория -->
            <div class="mb-3">
                <span
                    class="inline-flex items-center rounded-md bg-indigo-500/10 px-2 py-1 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-500/20">
                    {{ $article->category->name }}
                </span>
            </div>

            <h3 class="mb-3 text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2"
                itemprop="headline">
                {{ $article->title }}
            </h3>
            <p class="mb-4 text-gray-600 line-clamp-2" itemprop="description">
                {{ strip_tags($article->content) }}
            </p>
        </div>

        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <time datetime="{{ $article->created_at->format('Y-m-d') }}" itemprop="datePublished">
                    {{ $article->created_at->format('d.m.Y') }}
                </time>
                <span>{{ $article->views_count }} просмотров</span>
            </div>
            <a href="{{ route('news.show', $article->slug) }}"
                class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <span>Читать</span>
                <span class="mdi mdi-arrow-right ml-2"></span>
            </a>
        </div>
    </div>
</div>
