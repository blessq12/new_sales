<div class="rounded-2xl bg-white p-6 ring-1 ring-gray-200 hover:shadow-md transition-all duration-200" itemscope
    itemtype="http://schema.org/Review">
    <div class="flex items-center gap-x-2 mb-4">
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
        <span itemprop="itemReviewed" itemscope itemtype="https://schema.org/Product">
            <span itemprop="name">{{ $review->service->name }}</span>
            <meta itemprop="url" content="{{ route('services.show', [
                'category' => $review->service->category->slug,
                'slug' => $review->service->slug
            ]) }}">
            <meta itemprop="image" content="{{ Storage::disk('uploads')->url($review->service->image) }}">

            <span itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="5">
                <meta itemprop="reviewCount" content="{{ $review->service->reviews->count() }}">
            </span>

            <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <meta itemprop="availability" content="in stock">
                <meta itemprop="priceCurrency" content="RUB">
                <meta itemprop="price" content="{{ $review->service->price }}">
            </div>
        </span>
    </div>

    <blockquote class="text-gray-600 italic" itemprop="reviewBody">
        "{{ mb_strimwidth($review->message, 0, 100, '...') }}"
    </blockquote>


</div>
