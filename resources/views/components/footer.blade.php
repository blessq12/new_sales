<footer class="bg-gray-800 text-white pt-8">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h3 class="font-bold text-lg mb-2">О компании</h3>
            <hr class="border-gray-600 mb-2">
            <p>{{ $company->name }}</p>
            <p>{{ $company->description }}</p>
            <p>Телефоны:</p>
            <ul class="space-y-1">
                @foreach ($company->phones as $phone)
                    <li class="flex items-center space-x-2">
                        <i class="mdi mdi-phone"></i>
                        <a href="tel:{{ $phone }}" class="text-white underline">{{ $phone }}</a>
                    </li>
                @endforeach
            </ul>
            
            <p>Email: <a href="mailto:{{ $company->email }}" class="text-white underline">{{ $company->email }}</a></p>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-2">Ссылки</h3>
            <hr class="border-gray-600 mb-2">
            <ul>
                <li><a href="/about" class="text-white  hover:text-gray-400">О нас</a></li>
                <li><a href="/services" class="text-white  hover:text-gray-400">Услуги</a></li>
                <li><a href="/cooperation" class="text-white  hover:text-gray-400">Сотрудничество</a></li>
                <li><a href="/contacts" class="text-white  hover:text-gray-400">Контакты</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-2">Социальные сети</h3>
            <hr class="border-gray-600 mb-2">
            <div class="block space-y-2">
                @foreach ($company->socials as $social)
                <a href="{{ $social['url'] }}" class="block text-white hover:text-gray-400">{{ $social['title'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-gray-700 py-4 mt-8">
        <div class="mx-auto container">
            <p class="text-sm">© {{ date('Y') }} {{ $company->name }}. Все права защищены.</p>
        </div>
    </div>
    
</footer>

