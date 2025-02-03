@extends('layouts.main')

@section('title', 'Сертификаты')
@section('description', 'Сертификаты компании ООО "Салес"')

@section('content')
    <x-hero-banner
        :image="'https://www.sales-tomsk.ru/images/dest/bg3.jpg'"
        title="Сертификаты"
        description='Сертификаты компании ООО "Салес"'
        :breadcrumbs="[
            ['title' => 'Сертификаты', 'url' => '/certificates']
        ]"
    ></x-hero-banner>

    <!-- Описание -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Наши сертификаты</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Сертификаты, которые мы представляем, являются не только подтверждением качества нашей продукции, но и свидетельством нашего профессионализма и приверженности высоким стандартам.
                </p>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base leading-7 text-gray-700 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div>
                    <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <span class="mdi mdi-certificate-outline absolute left-1 top-1 text-indigo-600 text-xl"></span>
                            Качество
                        </dt>
                        <dd class="inline">Каждый сертификат подтверждает соответствие нашей продукции строгим требованиям и международным стандартам.</dd>
                    </div>
                </div>
                <div>
                    <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <span class="mdi mdi-shield-check-outline absolute left-1 top-1 text-indigo-600 text-xl"></span>
                            Гарантия
                        </dt>
                        <dd class="inline">Мы гарантируем качество наших услуг и подтверждаем это соответствующими сертификатами.</dd>
                    </div>
                </div>
                <div>
                    <div class="relative pl-9">
                        <dt class="inline font-semibold text-gray-900">
                            <span class="mdi mdi-hand-heart absolute left-1 top-1 text-indigo-600 text-xl"></span>
                            Доверие
                        </dt>
                        <dd class="inline">Наши сертификаты укрепляют доверие клиентов и демонстрируют нашу ответственность.</dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Галерея сертификатов -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach ($files as $file)
                    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:shadow-xl">
                        <div class="aspect-h-4 aspect-w-3 relative">
                            <img src="{{ Storage::disk('assets')->url('/images/docs/'.$file) }}" 
                                 alt="Сертификат" 
                                 class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
                            <!-- Оверлей при наведении -->
                            <div class="absolute inset-0 bg-transparent bg-opacity-0 transition-opacity duration-300 group-hover:bg-opacity-30 flex items-center justify-center">
                                <a href="{{ Storage::disk('assets')->url('/images/docs/'.$file) }}" 
                                   target="_blank" 
                                   class="rounded-full bg-white p-3 opacity-0 transform translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                                    <span class="mdi mdi-magnify text-xl text-gray-900"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA секция -->
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Готовы начать работу с нами?
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">
                    Наша команда сертифицированных специалистов готова помочь вам с любыми задачами.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('main.contacts') }}" 
                       class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Связаться с нами
                    </a>
                    <a href="{{ route('services') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Посмотреть услуги <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
