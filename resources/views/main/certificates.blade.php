@extends('layouts.main')

@section('title', 'Сертификаты')
@section('description', 'Сертификаты компании ООО "Салес"')

@section('content')
    <x-hero-banner
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
        <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Начните работать с нами сегодня
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                    Мы готовы помочь вам с любыми задачами. Наши специалисты обеспечат качественное выполнение работ в срок.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('main.contacts') }}"
                       class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Связаться с нами
                    </a>
                    <a href="{{ route('services') }}" class="text-sm font-semibold leading-6 text-white">
                        Наши услуги <span aria-hidden="true">→</span>
                    </a>
                </div>
                <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
@endsection
