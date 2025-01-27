<footer class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">О компании</h3>
                <div class="text-gray-400 space-y-2">
                    <p class="font-medium text-white">{{ $company->name }}</p>
                    <p class="text-sm">{{ $company->description }}</p>
                    <div class="space-y-2">
                        <p class="text-indigo-400 font-medium">Телефоны:</p>
                        <ul class="space-y-2">
                            @foreach ($company->phones as $phone)
                                <li>
                                    <a href="tel:{{ $phone }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                                        <span class="mdi mdi-phone text-indigo-400 mr-2"></span>
                                        {{ $phone }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <a href="mailto:{{ $company->email }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-email text-indigo-400 mr-2"></span>
                            {{ $company->email }}
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">Ссылки</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/about" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-information mr-2"></span>О нас
                        </a>
                    </li>
                    <li>
                        <a href="/services" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-tools mr-2"></span>Услуги
                        </a>
                    </li>
                    <li>
                        <a href="/cooperation" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-handshake mr-2"></span>Сотрудничество
                        </a>
                    </li>
                    <li>
                        <a href="/contacts" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-contacts mr-2"></span>Контакты
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-indigo-400 font-semibold text-lg">Социальные сети</h3>
                <div class="space-y-2">
                    @foreach ($company->socials as $social)
                        <a href="{{ $social['url'] }}" class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-{{ strtolower($social['title']) }} mr-2"></span>
                            {{ $social['title'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-sm text-gray-400 text-center">
                &copy; {{ date('Y') }} {{ $company->name }}. Все права защищены.
            </p>
        </div>
    </div>
</footer>
