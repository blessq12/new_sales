@extends('layouts.main')
@section('title', 'Профессиональные сантехники в Томске - Ваш надежный помощник!')
@section('description', 'Ищете качественные услуги сантехников в Томске? Мы предлагаем профессиональные решения для вашего дома. Звоните: 226-224')
@section('content')
    
    <div class="py-20 h-full container-fluid relative" style="background: url({{ Storage::disk('assets')->url('images/bg1.jpg') }}) no-repeat center center; background-size: cover;">
        <div class="overlay bg-black bg-opacity-70 absolute inset-0"></div>
        <div class="container text-white relative py-20 mx-auto">
            <div id="banner-text" class="text-left max-w-4xl opacity-1 transform transition duration-500 ease-in-out translate-y-4">
                <h5 class="mb-4 leading-tight text-2xl font-bold">Качественные услуги сантехников в Томске - мы здесь, чтобы помочь!</h5>
                <h1 class="font-bold text-6xl">Ваши сантехнические проблемы - наша забота!</h1>
                <p class="mt-4 text-lg">Звоните нам: 
                    <a href="tel:{{ $company->phones[0] }}" class="font-bold underline">{{ $company->phones[0] }}</a>
                </p>
                <div class="mt-8 flex justify-start space-x-4">
                    <a href="#" class="bg-yellow-600 hover:bg-yellow-700 text-black font-semibold py-3 px-6 rounded-lg text-lg transition duration-300 transform hover:scale-105">Получить консультацию</a>
                    <a href="{{ route('main.contacts') }}" class="border border-white hover:bg-white hover:text-black text-white font-semibold py-3 px-6 rounded-lg text-lg transition duration-300 transform hover:scale-105">Контакты</a>
                </div>
            </div>
        </div>
    </div>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Почему выбирают нас?</h2>
            <hr class="w-1/4 border-t-2 border-yellow-500 mx-auto my-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $advantages = [
                        ['title' => 'Профессионалы', 'text' => 'Каждый наш мастер - эксперт в своей области.', 'icon' => 'mdi mdi-account-check'],
                        ['title' => 'Соблюдение сроков', 'text' => 'Мы всегда выполняем обещания по срокам.', 'icon' => 'mdi mdi-clock-outline'],
                        ['title' => 'Быстрый выезд', 'text' => 'Приедем точно в назначенное время, когда это важно.', 'icon' => 'mdi mdi-car'],
                        ['title' => 'Контроль качества', 'text' => 'Поддерживаем связь с клиентами даже после завершения работ.', 'icon' => 'mdi mdi-checkbox-marked-circle-outline'],
                        ['title' => 'Примеры работ', 'text' => 'Вы можете увидеть наши выполненные проекты.', 'icon' => 'mdi mdi-home'],
                        ['title' => 'Помощь в покупках', 'text' => 'Поможем с выбором и доставкой материалов.', 'icon' => 'mdi mdi-cart'],
                        ['title' => 'Надежность', 'text' => 'Мы - реальная компания с офисом и постоянными мастерами.', 'icon' => 'mdi mdi-domain'],
                        ['title' => 'Гарантия 100%', 'text' => 'Даем 2 года гарантии на все виды работ.', 'icon' => 'mdi mdi-shield-check'],
                    ];
                @endphp
                @foreach($advantages as $advantage)
                    <div class="bg-white rounded-lg shadow-md p-6 flex transition-transform duration-300 transform hover:scale-105">
                        <i class="{{ $advantage['icon'] }} text-3xl text-yellow-500 mr-4"></i>
                        <div>
                            <h5 class="text-xl font-semibold">{{ $advantage['title'] }}</h5>
                            <p class="text-gray-600">{{ $advantage['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Услуги, которые мы предлагаем</h2>
            <hr class="w-1/4 border-b-2 border-yellow-500 mx-auto my-6">
        </div>
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                @foreach($services as $service)
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-row h-full">
                            @if($service->image)
                                <img src="{{ Storage::disk('uploads')->url($service->image) }}" alt="{{ $service->name }}" class="w-1/3 h-auto object-cover">
                            @endif
                            <div class="p-4 flex flex-col flex-grow">
                                <h5 class="text-xl font-semibold mb-1">{{ $service->name }}</h5>
                                <p class="text-gray-700 flex-grow text-sm">{{ $service->description }}</p>
                                <a href="{{ route('services.show', $service->slug) }}" class="mt-2 inline-block bg-blue-500 text-white text-center py-1 px-3 rounded hover:bg-blue-600 transition">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container mx-auto text-center mt-8">
            <a href="{{ route('services') }}" class="inline-block bg-yellow-500 text-black font-semibold py-3 px-6 rounded-lg hover:bg-yellow-600 transition transform hover:scale-110">
                Посмотреть все услуги
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>
    </section>
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Отзывы наших клиентов</h2>
            <hr class="w-1/4 border-b-2 border-yellow-500 mx-auto my-6 ">
        </div>
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                @php
                    $testimonials = [
                        ['name' => 'Анна Иванова', 'text' => 'Отличные сантехники! Работа выполнена быстро и качественно.', 'image' => 'testimonial1.jpg'],
                        ['name' => 'Игорь Петров', 'text' => 'Очень доволен услугами, рекомендую!', 'image' => 'testimonial2.jpg'],
                        ['name' => 'Мария Смирнова', 'text' => 'Профессиональный подход и отличное качество.', 'image' => 'testimonial3.jpg'],
                        ['name' => 'Сергей Кузнецов', 'text' => 'Работа выполнена в срок, все на высшем уровне.', 'image' => 'testimonial4.jpg'],
                        ['name' => 'Елена Васильева', 'text' => 'Сантехники очень вежливые и профессиональные.', 'image' => 'testimonial5.jpg'],
                    ];
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-row h-full">
                            <img src="{{ Storage::disk('assets')->url('images/' . $testimonial['image']) }}" alt="Отзыв клиента" class="w-1/3 h-auto object-cover">
                            <div class="p-4 flex flex-col flex-grow">
                                <h5 class="text-xl font-semibold mb-1">{{ $testimonial['name'] }}</h5>
                                <p class="text-gray-700 flex-grow text-sm">{{ $testimonial['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="mx-auto bg-yellow-500 rounded-lg shadow-md overflow-hidden flex  h-full justify-center items-center cursor-pointer hover:bg-yellow-600">
                        <i class="mdi mdi-pencil mb-2 text-white text-2xl px-3"></i>
                        <a href="javascript:void(0)" onclick="alert('Оставить отзыв')" class="flex items-center text-white font-semibold py-3 px-6 rounded-lg transition w-full text-center">
                             Оставить отзыв
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto flex">
            <div class="w-1/2 pr-4">
                <h2 class="text-3xl font-bold text-center">Информация о компании</h2>
                <p class="mt-4">{{ $company->name }}</p>
                <p>{{ $company->description }}</p>
                <p>Телефон: 
                    <div class="block"> 
                        @foreach($company->phones as $phone)
                            <a href="tel:{{ $phone }}" class="font-bold underline block">{{ $phone }}</a>
                        @endforeach
                    </div>
                </p>
                <p>Email: 
                    <div class="block">
                        @foreach($company->emails as $email)
                            <a href="mailto:{{ $email }}" class="font-bold underline block">{{ $email }}</a>
                        @endforeach
                    </div>
                </p>
                <p>Адреса:
                    <div class="block">
                        @foreach($company->addresses as $address)
                            <p class="font-bold underline block">{{ $address }}</p>
                        @endforeach
                    </div>
                </p>
                
            </div>
            <div class="w-1/2 pl-4">
                <h2 class="text-3xl font-bold text-center">Карта и адреса</h2>
                <div id="map" class="h-64 w-full mt-4"></div>
                <select id="address-selector" class="mt-4 w-full">
                    <option value="address1">Адрес 1</option>
                    <option value="address2">Адрес 2</option>
                </select>
            </div>
        </div>
    </section>
    
@endsection
