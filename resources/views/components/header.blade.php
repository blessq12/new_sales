<nav class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Верхняя панель с контактами -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-10 text-sm">
                <div class="flex items-center space-x-4 hidden md:flex">
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
                <div class="flex md:hidden">
                    <a href="tel:{{ $company->phones[0] }}" class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                        <span class="mdi mdi-phone text-indigo-600 mr-1"></span>
                        {{ $company->phones[0] }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 flex items-center">
                        <span class="mdi mdi-clock text-indigo-600 mr-1"></span>
                        <span class="hidden md:block">Ежедневно с</span> 8:00 до 22:00
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
                    @click="openModal('callback')"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200"
                >
                    Заказать звонок
                </button>
            </div>

            <!-- Мобильная кнопка меню -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition-colors duration-200" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть меню</span>
                    <span class="mdi mdi-menu text-2xl menu-icon"></span>
                    <span class="mdi mdi-close text-2xl close-icon hidden"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div id="mobile-menu" class="fixed inset-0 z-50 bg-white md:hidden transform translate-y-full transition-transform duration-200">
        <div class="h-full flex flex-col">
            <!-- Верхняя панель с поиском и кнопкой закрытия -->
            <div class="p-4 border-b flex items-center justify-between">
                <div class="flex-1 mr-4">
                    <form action="?" method="GET" class="relative">
                        <input type="text" 
                               name="q" 
                               placeholder="Поиск по сайту..." 
                               class="w-full px-4 py-2 pr-10 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                            <span class="mdi mdi-magnify text-gray-400"></span>
                        </button>
                    </form>
                </div>
                <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-gray-100">
                    <span class="mdi mdi-close text-2xl"></span>
                </button>
            </div>

            <!-- Навигационные ссылки -->
            <div class="flex-1 overflow-y-auto">
                <nav class="px-4 py-6 space-y-4">
                    <a href="{{ route('main.about') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-information-outline mr-3"></span>О нас
                    </a>
                    <a href="{{ route('main.certificates') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-certificate mr-3"></span>Сертификаты
                    </a>
                    <div class="services-dropdown">
                        <button class="w-full flex items-center justify-between px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                            <span class="flex items-center">
                                <span class="mdi mdi-tools mr-3"></span>Услуги
                            </span>
                            <span class="mdi mdi-chevron-down transition-transform duration-200"></span>
                        </button>
                        <div class="services-content hidden pl-4 mt-2 space-y-2">
                            @foreach($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}" 
                                   class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('main.cooperation') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-certificate mr-3"></span>Сотрудничество
                    </a>
                    <a href="{{ route('main.contacts') }}" class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-phone mr-3"></span>Контакты
                    </a>
                </nav>
            </div>

            <!-- Нижняя панель с контактами -->
            <div class="border-t p-4 space-y-2">
                <div class="space-y-2">
                    @foreach($company->phones as $phone)
                        <a href="tel:{{ $phone }}" class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 rounded-xl transition-colors duration-200">
                            <span class="mdi mdi-phone text-indigo-600 mr-2"></span>
                            {{ $phone }}
                        </a>
                    @endforeach
                    <a href="mailto:{{ $company->emails[0] }}" class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-email text-indigo-600 mr-2"></span>
                        {{ $company->emails[0] }}
                    </a>
                </div>

                <button 
                    @click="openModal('callback')"
                    class="w-full flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors duration-200"
                >
                    <span class="mdi mdi-phone-in-talk mr-2"></span>
                    Заказать звонок
                </button>

            </div>
        </div>
    </div>
</nav>
