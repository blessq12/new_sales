<div class="rounded-2xl bg-white p-6 ring-1 ring-gray-200 hover:shadow-md transition-all duration-200" itemscope
    itemtype="http://schema.org/Review">
    <div class="flex items-center gap-x-2 mb-4">
        {{-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50 object-cover" src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}"> --}}
        <div>
            <div itemprop="author" itemscope itemtype="http://schema.org/Person">
                <span class="font-semibold text-gray-900" itemprop="name">{{ $review->name }}</span>
            </div>
            <div class="text-gray-600" itemprop="datePublished">{{ $review->created_at->format('d.m.Y') }}</div>
        </div>
    </div>

    <div class="flex items-center mb-2" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
        <meta itemprop="ratingValue" content="{{ $review->rating }}">
        <meta itemprop="bestRating" content="5">
        @for ($i = 0; $i < $review->rating; $i++)
            <span class="mdi mdi-star text-yellow-400"></span>
        @endfor
    </div>

    <div class="text-sm text-gray-900 mb-4">
        <span class="font-semibold">Услуга:</span>
        <span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product">
            <span itemprop="name">{{ $review->service->name }}</span>
        </span>
    </div>

    <blockquote class="text-gray-600 italic" itemprop="reviewBody">
        "{{ mb_strimwidth($review->message, 0, 100, '...') }}"
    </blockquote>
</div>
