<div class="group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:shadow-xl">
    <!-- Изображение с эффектом масштабирования при наведении -->
    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
        <img src="{{ Storage::disk('uploads')->url($service->image) }}" 
             alt="{{ $service->name }}" 
             class="h-48 w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
    </div>
    
    <!-- Контент -->
    <div class="p-6">
        <div class="min-h-[180px]">
            <h3 class="mb-3 text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                {{ $service->name }}
            </h3>
            <p class="mb-4 text-gray-600 line-clamp-3">
                {{ $service->description }}
            </p>
        </div>

        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-baseline">
                <span class="mr-1 text-sm text-gray-500">{{ $service->prefix }}</span>
                <span class="text-2xl font-bold text-indigo-600">{{ $service->price }}</span>
            </div>
            <a href="{{ route('services.show', $service->slug) }}" 
               class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <span>Подробнее</span>
                <span class="mdi mdi-arrow-right ml-2"></span>
            </a>
        </div>
    </div>
</div>
