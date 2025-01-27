<nav class="bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="{{ route('main.index') }}" class="text-white text-xl font-bold">Главная</a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('main.about') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">О нас</a>
                    <a href="{{ route('main.certificates') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Сертификаты</a>
                    <div class="relative group" onmouseover="document.querySelector('#services-dropdown').classList.toggle('hidden');">
                        <a href="{{ route('services') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium" >Все услуги</a>
                        <div class="absolute overflow-hidden left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden group-hover:block" id="services-dropdown">
                            @foreach($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">{{ $service->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('main.contacts') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Контакты</a>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть меню</span>
                    <!-- Иконка закрытого меню -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div class="md:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('main.about') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">О нас</a>
            <a href="{{ route('main.certificates') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Сертификаты</a>
            <a href="{{ route('services') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Услуги</a>
            <a href="{{ route('main.contacts') }}" class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Контакты</a>
        </div>
    </div>
</nav>
