@extends('layouts.main')
@section('title', 'Профессиональные сантехники в Томске - Ваш надежный помощник!')
@section('description', 'Ищете качественные услуги сантехников в Томске? Мы предлагаем профессиональные решения для вашего дома. Звоните: 226-224')
@section('content')
    
    <!-- Hero секция -->
    <div class="relative isolate overflow-hidden">
        <img src="{{ Storage::disk('assets')->url('images/bg1.jpg') }}" alt="Background" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/60 -z-10"></div>

        <!-- Декоративный элемент -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:py-40 lg:px-8">
            
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl lg:text-7xl max-w-full lg:max-w-[75%]">
                    Ваши сантехнические проблемы - наша забота!
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-300 ">
                    Качественные услуги сантехников в Томске - мы здесь, чтобы помочь!
                </p>
                <p class="mt-4 text-xl text-gray-300">
                    Звоните нам: 
                    <a href="tel:{{ $company->phones[0] }}" class="font-bold text-white hover:text-indigo-400 transition-colors">
                        {{ $company->phones[0] }}
                    </a>
                </p>
                <div class="mt-10 block md:flex items-center gap-x-6">
                    <a 
                        href="javascript:void(0)" 
                        class="rounded-xl bg-indigo-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 hover:scale-105 mb-4 md:mb-0 block md:inline-block"
                        @click="openModal('callback')"
                    >
                        Консультация
                    </a>
                    <a href="{{ route('main.contacts') }}" class="rounded-xl px-6 py-3 text-lg font-semibold text-white ring-1 ring-inset ring-white/30 hover:ring-white/60 transition-all duration-200 hover:scale-105 mb-4 md:mb-0 block md:inline-block">
                        Контакты
                    </a>
                
            </div>
        </div>
    </div>

    <!-- Преимущества -->
    <section class="py-24 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Наши преимущества</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Почему выбирают нас?
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Мы предоставляем качественные услуги и гарантируем результат
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-4">
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
                        <div class="group relative rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:shadow-md hover:ring-gray-300 transition-all duration-200">
                            <dt class="flex items-center gap-x-3">
                                <span class="{{ $advantage['icon'] }} text-3xl text-indigo-600"></span>
                                <span class="text-lg font-semibold leading-7 text-gray-900">{{ $advantage['title'] }}</span>
                            </dt>
                            <dd class="mt-4 text-base leading-7 text-gray-600">{{ $advantage['text'] }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>

    <!-- Услуги -->
    <section class="py-24 bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Наши услуги</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Услуги, которые мы предлагаем
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Выберите необходимую услугу из нашего каталога
                </p>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Отзывы -->
    <section class="py-24 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Отзывы клиентов</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Что говорят о нас клиенты
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Более 1000 довольных клиентов доверяют нам свои сантехнические работы
                </p>
                <div class="mt-6">
                    <button 
                        @click="openModal('review')"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                    >
                        <span class="mdi mdi-plus-circle mr-2"></span>
                        @if($reviews->isEmpty())
                            Оставите первый отзыв о нас
                        @else
                            Оставить отзыв
                        @endif
                    </button>
                </div>
            </div>

            <div class="mx-auto mt-16 grid max-w-4xl grid-cols-1 grid-rows-1 gap-6 text-sm leading-6 text-gray-900 sm:mt-20 sm:grid-cols-3 xl:mx-0 xl:max-w-none xl:grid-cols-3">
                @foreach($reviews as $review)
                    <div class="rounded-2xl bg-white p-6 ring-1 ring-gray-200 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-x-2 mb-4">
                            {{-- <img class="h-12 w-12 flex-none rounded-full bg-gray-50 object-cover" src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}"> --}}
                            <div>
                                <div class="font-semibold text-gray-900">{{ $review->name }}</div>
                                <div class="text-gray-600">{{ $review->created_at->format('d.m.Y') }}</div>
                            </div>
                        </div>

                        <div class="flex items-center mb-2">
                            @for($i = 0; $i < $review->rating; $i++)
                                <span class="mdi mdi-star text-yellow-400"></span>
                            @endfor
                        </div>

                        <div class="text-sm text-gray-900 mb-4">
                            <span class="font-semibold">Услуга:</span> {{ $review->service->name }}
                        </div>

                        <blockquote class="text-gray-600 italic">
                            "{{ mb_strimwidth($review->message, 0, 100, '...') }}"
                        </blockquote>
                    </div>
                @endforeach
                </div>
            {{-- <div class="mt-16 flex justify-center">
                <a href="javascript:void(0)" class="rounded-xl bg-indigo-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 hover:scale-105">
                    Смотреть все отзывы
                </a>
            </div> --}}
        </div>
    </section>

    <!-- Контакты -->
    <section class="relative isolate overflow-hidden bg-white py-24 sm:py-32">
        <div class="absolute -top-80 left-[max(6rem,33%)] -z-10 transform-gpu blur-3xl sm:left-1/2 md:top-20 lg:ml-20 xl:top-3 xl:ml-56" aria-hidden="true">
            <div class="aspect-[801/1036] w-[50.0625rem] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-30"></div>
        </div>
        
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 text-indigo-600">Контакты</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $company->name }}</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            {{ $company->description }}
                        </p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <span class="mdi mdi-map-marker absolute left-1 top-1 text-indigo-600"></span>
                                    Адреса:
                                </dt>
                                @foreach ( $company->addresses as $address )
                                <ul>
                                    <li>{{ $address }}</li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <span class="mdi mdi-phone absolute left-1 top-1 text-indigo-600"></span>
                                    Телефоны:
                                </dt>
                                @foreach ( $company->phones as $phone )
                                <ul>
                                    <li>
                                        <a href="tel:{{ $phone }}" class="hover:text-indigo-600 transition-colors">
                                            {{ $phone }}
                                        </a>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900">
                                    <span class="mdi mdi-email absolute left-1 top-1 text-indigo-600"></span>
                                    Email:
                                </dt>
                                <ul>
                                    @foreach ( $company->emails as $email )
                                    <li>
                                        <a href="mailto:{{ $email }}" class="hover:text-indigo-600 transition-colors">
                                            {{ $email }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                    
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
                <iframe src="https://yandex.ru/map-widget/v1/?ll=84.980994%2C56.503963&mode=whatshere&whatshere%5Bpoint%5D=84.980976%2C56.503885&whatshere%5Bzoom%5D=17&z=17.14" 
                    class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0 block md:hidden" width="600" height="300"
                    frameborder="0"
                ></iframe>
                <iframe src="https://yandex.ru/map-widget/v1/?ll=84.980994%2C56.503963&mode=whatshere&whatshere%5Bpoint%5D=84.980976%2C56.503885&whatshere%5Bzoom%5D=17&z=17.14" 
                    class="w-[48rem] max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem] md:-ml-4 lg:-ml-0 hidden md:block" width="1500" height="900"
                    frameborder="0"
                ></iframe>
            </div>
        </div>
    </section>

@endsection
