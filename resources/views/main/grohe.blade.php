@extends('layouts.main')

@section('title', 'Ремонт и установка сантехники GROHE в Томске')
@section('description',
    'Профессиональный ремонт и установка сантехники GROHE. Работаем 24/7. Выезд по Томской области.
    Гарантия на все работы.')

@section('content')
    {{-- <x-hero-banner :title="'Ремонт сантехники GROHE'" :description="'Профессиональный ремонт и установка сантехники GROHE в Томске. Выезд мастера 24/7 по всей Томской области.'" :breadcrumbs="[['title' => 'GROHE', 'url' => '/grohe']]"></x-hero-banner> --}}

    <div class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white">
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8 py-12 sm:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="inline-flex items-center bg-indigo-600/10 text-indigo-600 rounded-full px-4 py-1.5 mb-6">
                        <span class="mdi mdi-shield-check text-xl mr-2"></span>
                        <span class="font-semibold">Официальный представитель GROHE</span>
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl mb-6">Эксперты в ремонте и
                        установке
                        сантехники GROHE</h2>
                    <p class="text-xl text-gray-600 mb-8">Выезжаем в любое время суток по всей Томской области. Работаем с
                        установками любой сложности!</p>
                    <div class="flex justify-center gap-4">
                        <a href="tel:{{ $company->phones[0] }}"
                            class="inline-flex w-full items-center justify-center px-3 py-1 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition-colors duration-200">
                            <span class="mdi mdi-phone text-2xl mr-2"></span>
                            Вызвать мастера
                        </a>
                        <a href="#order-parts"
                            class="inline-flex w-full items-center justify-center px-3 py-1 border-2xnj border-indigo-600 text-indigo-600 rounded-xl font-semibold hover:bg-indigo-700 hover:text-white transition-colors duration-200">
                            <span class="mdi mdi-cog text-2xl mr-2"></span>
                            Заказать запчасти
                        </a>
                    </div>
                </div>
                <div class="relative lg:ml-12">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl shadow-2xl relative">
                        <img src="/assets/images/grohe.png" alt="GROHE сантехника"
                            class="object-cover rounded-2xl shadow-xl">

                        <div class="absolute -bottom-6 -left-6 p-4 bg-gray-50 border border-gray-200 rounded-xl shadow-xl">
                            <h3 class="text-2xl font-bold">GROHE</h3>
                            <p class="text-gray-600">Сантехника для вашего дома</p>
                        </div>
                    </div>
                </div>
            </div>

            <grohe-services></grohe-services>

            <div class="relative py-24 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white"></div>
                <div class="relative container mx-auto px-4">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl mb-6">Почему выбирают нас
                        </h2>
                        <p class="text-xl text-gray-600">Более 5000 довольных клиентов в Томске доверяют нам свою сантехнику
                            GROHE</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="group p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-indigo-600/10 text-indigo-600 rounded-xl mb-6 group-hover:scale-110 transition-transform duration-200">
                                <span class="mdi mdi-flash text-2xl"></span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Быстрый выезд</h3>
                            <p class="text-gray-600 text-sm">Приезжаем в течение 30 минут по всей Томской области</p>
                        </div>

                        <div class="group p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-indigo-600/10 text-indigo-600 rounded-xl mb-6 group-hover:scale-110 transition-transform duration-200">
                                <span class="mdi mdi-shield-check text-2xl"></span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Гарантия качества</h3>
                            <p class="text-gray-600 text-sm">Даём гарантию на все виды работ и запчасти</p>
                        </div>

                        <div class="group p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-indigo-600/10 text-indigo-600 rounded-xl mb-6 group-hover:scale-110 transition-transform duration-200">
                                <span class="mdi mdi-currency-rub text-2xl"></span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Честные цены</h3>
                            <p class="text-gray-600 text-sm">Стоимость озвучиваем до начала работ</p>
                        </div>

                        <div class="group p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-indigo-600/10 text-indigo-600 rounded-xl mb-6 group-hover:scale-110 transition-transform duration-200">
                                <span class="mdi mdi-wrench text-2xl"></span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Профессионализм</h3>
                            <p class="text-gray-600 text-sm">10+ лет опыта работы с GROHE</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-24 relative">
                <div class="absolute -top-24" id="order-parts"></div>
                <order-parts></order-parts>
            </div>

            <x-front-cta />


        @endsection
