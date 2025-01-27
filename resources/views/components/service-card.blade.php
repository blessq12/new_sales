<div class="border border-gray-200 rounded-lg p-4 shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col justify-between">
    <img src="{{ Storage::disk('uploads')->url($service->image) }}" alt="{{ $service->name }}" class="rounded-md mb-4">
    <h3 class="text-2xl font-bold text-blue-600">{{ $service->name }}</h3>
    <p class="text-gray-700">{{ $service->description }}</p>

    <p class="text-lg font-semibold text-gray-800">{{ $service->prefix }} {{ $service->price }}</p>
    <a href="{{ route('services.show', $service->slug) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-200">Подробнее</a>
</div>
