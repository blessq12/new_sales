<nav x-data="{ isOpen: false }" class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Верхняя панель с контактами -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-10 text-sm">
                <div class="flex items-center space-x-4">
                    @foreach($company->phones as $phone)
                        <a href="tel:{{ $phone }}" class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                            <span class="mdi mdi-phone text-indigo-600 mr-1"></span>
                            {{ $phone }}
                        </a>
                    @endforeach
                    <a href="mailto:{{ $company->email }}" class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                        <span class="mdi mdi-email text-indigo-600 mr-1"></span>
                        {{ $company->email }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 flex items-center">
                        <span class="mdi mdi-clock text-indigo-600 mr-1"></span>
                        Ежедневно с 8:00 до 22:00
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Основная навигация -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('main.index') }}" class="flex-shrink-0 flex items-center">
                    <img src="{{ Storage::disk('assets')->url('images/logo.svg') }}" alt="Логотип" class="h-8 w-auto">
                    <span class="ml-2 text-xl font-bold text-gray-900">{{ $company->name }}</span>
                </a>
            </div>
            
            <!-- Десктопное меню -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="{{ route('main.about') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                    <span class="mdi mdi-information-outline mr-1"></span>О нас
                </a>
                <a href="{{ route('main.certificates') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                    <span class="mdi mdi-certificate mr-1"></span>Сертификаты
                </a>
                <div class="relative group">
                    <button class="text-gray-700 group hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center transition-colors duration-200">
                        <span class="mdi mdi-tools mr-1"></span>Услуги
                        <span class="mdi mdi-chevron-down ml-1 text-gray-400 group-hover:text-indigo-600 transition-transform duration-200 group-hover:rotate-180"></span>
                    </button>
                    <div class="absolute right-0 w-64 mt-2 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                        <div class="py-2">
                            @foreach($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <span class="mdi mdi-check text-indigo-600 mr-2 opacity-0 transition-opacity duration-200 hover:opacity-100"></span>
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{ route('main.contacts') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center">
                    <span class="mdi mdi-phone mr-1"></span>Контакты
                </a>
                <button 
                    onclick="openCallbackForm()"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200"
                >
                    Заказать звонок
                </button>
            </div>

            <!-- Мобильная кнопка меню -->
            <div class="flex items-center md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition-colors duration-200" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть меню</span>
                    <span class="mdi mdi-menu text-2xl" x-show="!isOpen"></span>
                    <span class="mdi mdi-close text-2xl" x-show="isOpen" style="display: none;"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('main.about') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                <span class="mdi mdi-information-outline mr-2"></span>О нас
            </a>
            <a href="{{ route('main.certificates') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                <span class="mdi mdi-certificate mr-2"></span>Сертификаты
            </a>
            <div x-data="{ isServicesOpen: false }">
                <button @click="isServicesOpen = !isServicesOpen" class="w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                    <span class="mdi mdi-tools mr-2"></span>Услуги
                    <span class="mdi mdi-chevron-down ml-1 transition-transform duration-200" :class="{ 'transform rotate-180': isServicesOpen }"></span>
                </button>
                <div x-show="isServicesOpen" class="pl-4" style="display: none;">
                    @foreach($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                            {{ $service->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('main.contacts') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200">
                <span class="mdi mdi-phone mr-2"></span>Контакты
            </a>
            <div class="px-3 py-2">
                <button 
                    onclick="openCallbackForm()"
                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200"
                >
                    Заказать звонок
                </button>
            </div>
        </div>
    </div>
</nav>
