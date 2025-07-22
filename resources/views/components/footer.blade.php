<footer class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- О компании -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <img src="/assets/images/logo.png" alt="{{ $company->name }}" class="h-8 w-auto">
                    <div class="block">
                        <span class="ml-2 text-xl font-bold text-white block leading-none">{{ $company->name }}</span>
                        <span class="ml-2 text-sm text-gray-400 block leading-none">работаем с 2009 года</span>
                    </div>
                </div>
                <p class="text-sm text-gray-400">{{ $company->description }}</p>
                <div class="space-y-2">
                    @foreach ($company->addresses as $address)
                        <p class="flex items-start text-sm text-gray-400">
                            <span class="mdi mdi-map-marker text-indigo-400 mr-2 mt-1"></span>
                            {{ $address }}
                        </p>
                    @endforeach
                </div>
            </div>

            <!-- Контакты -->
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">Контакты</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-white font-medium mb-2">Телефоны:</p>
                        @foreach ($company->phones as $phone)
                            <a href="tel:{{ $phone }}"
                                class="block text-gray-400 hover:text-white transition-colors duration-200">
                                <span class="mdi mdi-phone text-indigo-400 mr-2"></span>
                                {{ $phone }}
                            </a>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-white font-medium mb-2">Email:</p>
                        @foreach ($company->emails as $email)
                            <a href="mailto:{{ $email }}"
                                class="block text-gray-400 hover:text-white transition-colors duration-200">
                                <span class="mdi mdi-email text-indigo-400 mr-2"></span>
                                {{ $email }}
                            </a>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-white font-medium mb-2">Режим работы:</p>
                        <p class="text-gray-400">
                            <span class="mdi mdi-clock text-indigo-400 mr-2"></span>
                            Ежедневно с 8:00 до 22:00
                        </p>
                    </div>
                </div>
            </div>

            <!-- Навигация -->
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">Навигация</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('main.about') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-information mr-2"></span>О нас
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main.groheService') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-certificate mr-2"></span>Grohe Сервис
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-tools mr-2"></span>Услуги
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main.contacts') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-phone mr-2"></span>Контакты
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('main.cooperation') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-handshake mr-2"></span>Сотрудничество
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reviews.index') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-comment mr-2"></span>Отзывы
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Социальные сети -->
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">Мы в соцсетях</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($company->socials as $social)
                        <a href="{{ $social['url'] }}"
                            class="flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-{{ strtolower($social['icon']) }} text-indigo-400 mr-2"></span>
                            {{ $social['title'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Нижняя секция с юридической информацией -->
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 items-center">
                <div class="text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ $company->name }}. Все права защищены.</p>
                    <p class="mt-1 flex space-x-2">ИНН: &nbsp;
                        @foreach ($company->legals as $legal)
                            <span>{{ $legal->inn }} </span>
                        @endforeach

                    </p>
                </div>
                <div class="flex flex-wrap gap-4 md:justify-end text-sm">
                    <a href="{{ route('main.privacy') }}"
                        class="text-gray-400 hover:text-white transition-colors duration-200">
                        Политика конфиденциальности
                    </a>
                    <a href="{{ route('main.agreement') }}"
                        class="text-gray-400 hover:text-white transition-colors duration-200">
                        Пользовательское соглашение
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
