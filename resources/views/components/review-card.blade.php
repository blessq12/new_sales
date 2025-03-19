<div class="rounded-2xl bg-white p-6 ring-1 ring-gray-200 hover:shadow-md transition-all duration-200">
    <div class="flex items-center gap-x-2 mb-4">
        {{-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50 object-cover" src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}"> --}}
        <div>
            <div class="font-semibold text-gray-900">{{ $review->name }}</div>
            <div class="text-gray-600">{{ $review->created_at->format('d.m.Y') }}</div>
        </div>
    </div>

    <div class="flex items-center mb-2">
        @for ($i = 0; $i < $review->rating; $i++)
            <span class="mdi mdi-star text-yellow-400"></span>
        @endfor
    </div>

    <div class="text-sm text-gray-900 mb-4">
        <span class="font-semibold">Услуга:</span> {{ $review->service->name }}
    </div>

    <blockquote class="text-gray-600 italic">
        "{{ mb_strimwidth($review->message, 0, 100, '...') }}"
    </blockquote>
</div>
