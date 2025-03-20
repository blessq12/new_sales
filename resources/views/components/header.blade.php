<nav class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Верхняя панель с контактами -->
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-10 text-sm">
                <div class="flex items-center space-x-4 hidden md:flex">
                    @foreach ($company->phones as $phone)
                        <a href="tel:{{ $phone }}"
                            class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                            <span class="mdi mdi-phone text-indigo-600 mr-1"></span>
                            {{ $phone }}
                        </a>
                    @endforeach
                    <a href="mailto:{{ $company->email }}"
                        class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
                        <span class="mdi mdi-email text-indigo-600 mr-1"></span>
                        {{ $company->email }}
                    </a>
                </div>
                <div class="flex md:hidden">
                    <a href="tel:{{ $company->phones[0] }}"
                        class="text-gray-600 hover:text-indigo-600 transition-colors duration-200 flex items-center">
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
                    <img src="{{ Storage::disk('assets')->url('images/logo.png') }}" alt="Логотип" class="h-8 w-auto">
                    <div class="block">
                        <span
                            class="ml-2 text-xl font-bold text-gray-900 block leading-none">{{ $company->name }}</span>
                        <span class="ml-2 text-sm text-gray-400 block leading-none" style="font-size: 10px;">работаем с
                            2009 года</span>
                    </div>
                </a>
            </div>

            <!-- Десктопное меню -->
            <div class="hidden md:flex md:items-center md:space-x-3">
                <a href="{{ route('main.about') }}"
                    class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    О нас
                </a>
                <a href="{{ route('main.certificates') }}"
                    class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Сертификаты
                </a>
                <a href="{{ route('main.gallery') }}"
                    class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Галерея
                </a>
                <div class="relative group">
                    <button
                        class="text-gray-700 group hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center transition-colors duration-200"
                        onclick="{
                            document.getElementById('services-dropdown').classList.toggle('opacity-0');
                            document.getElementById('services-dropdown').classList.toggle('invisible');
                        }">
                        Услуги
                        <span
                            class="ml-1 text-gray-400 group-hover:text-indigo-600 transition-transform duration-200 group-hover:rotate-180">▼</span>
                    </button>
                    <div id="services-dropdown"
                        class="max-h-[500px] overflow-y-auto absolute right-0 w-64 mt-2 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                        <div class="py-2">
                            <a href="{{ route('services') }}" class="flex items-center px-4 py-2 text-sm">
                                <div
                                    class="text-center bg-indigo-50 rounded-xl px-2 py-1 w-full hover:bg-indigo-600 hover:text-white transition-colors duration-200">
                                    Все услуги
                                </div>
                            </a>
                            @foreach ($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{ route('reviews.index') }}"
                    class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Отзывы
                </a>
                <a href="{{ route('main.contacts') }}"
                    class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                    Контакты
                </a>
                <button @click="openModal('callback')"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                    Оставить заявку
                </button>
            </div>

            <!-- Мобильная кнопка меню -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-button" @click="toggleMobileMenu()"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none transition-colors duration-200"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Открыть меню</span>
                    <span class="mdi mdi-menu text-2xl menu-icon"></span>
                    <span class="mdi mdi-close text-2xl close-icon hidden"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню -->
    <div v-if="appStore.mobileMenu"
        class="fixed inset-0 z-50 bg-white md:hidden transform transition-transform duration-200"
        style="translate-y: 0;">
        <div class="h-full flex flex-col">
            <!-- Верхняя панель с поиском и кнопкой закрытия -->
            <div class="p-4 border-b flex items-center justify-between">
                <div class="flex-1 mr-4">
                    <search-component type="mobile"></search-component>
                </div>
                <button id="mobile-menu-close" @click="toggleMobileMenu" class="p-2 rounded-lg hover:bg-gray-100">
                    <span class="mdi mdi-close text-2xl"></span>
                </button>
            </div>

            <!-- Навигационные ссылки -->
            <div class="flex-1 overflow-y-auto">
                <nav class="px-4 py-6 space-y-4">
                    <a href="{{ route('main.about') }}"
                        class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        О нас
                    </a>
                    <a href="{{ route('main.certificates') }}"
                        class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        Сертификаты
                    </a>
                    <a href="{{ route('main.gallery') }}"
                        class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        Галерея
                    </a>
                    <div class="services-dropdown">
                        <button
                            class="w-full flex items-center justify-between px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200"
                            onclick="document.querySelector('.services-content').classList.toggle('hidden')">
                            <span>Услуги</span>
                            <span>▼</span>
                        </button>
                        <div class="services-content hidden pl-4 mt-2 space-y-2">
                            @foreach ($services as $service)
                                <a href="{{ route('services.show', $service->slug) }}"
                                    class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                                    {{ $service->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('main.contacts') }}"
                        class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        Контакты
                    </a>
                    <a href="{{ route('reviews.index') }}"
                        class="block px-4 py-3 text-lg font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors duration-200">
                        Отзывы
                    </a>
                </nav>
            </div>

            <!-- Нижняя панель с контактами -->
            <div class="border-t p-4 space-y-2">
                <div class="space-y-2">
                    @foreach ($company->phones as $phone)
                        <a href="tel:{{ $phone }}"
                            class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 rounded-xl transition-colors duration-200">
                            <span class="mdi mdi-phone text-indigo-600 mr-2"></span>
                            {{ $phone }}
                        </a>
                    @endforeach
                    <a href="mailto:{{ $company->emails[0] }}"
                        class="block px-4 py-2 text-base text-gray-600 hover:text-indigo-600 rounded-xl transition-colors duration-200">
                        <span class="mdi mdi-email text-indigo-600 mr-2"></span>
                        {{ $company->emails[0] }}
                    </a>
                </div>

                <button @click="openModal('callback')"
                    class="w-full flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm transition-colors duration-200">
                    <span class="mdi mdi-phone-in-talk mr-2"></span>
                    Оставить заявку
                </button>

            </div>
        </div>
    </div>
</nav>
