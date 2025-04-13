@extends('layouts.main')

@section('title', $service->name)
@section('description', $service->description)

@section('content')
    <div itemscope itemtype="https://schema.org/Service">
        <meta itemprop="name" content="{{ $service->name }}">
        <meta itemprop="description" content="{{ $service->description }}">
        <meta itemprop="image" content="{{ Storage::disk('uploads')->url($service->image) }}">
        <x-hero-banner :image="Storage::disk('uploads')->url($service->image)" :title="$service->name" :description="$service->description" :breadcrumbs="[
            ['title' => 'Услуги', 'url' => route('services')],
            ['title' => $category->name, 'url' => route('services.category', $category->slug)],
            [
                'title' => $service->name,
                'url' => route('services.show', [
                    'category' => $category->slug,
                    'slug' => $service->slug,
                ]),
            ],
        ]"></x-hero-banner>

        <div class="max-w-7xl mx-auto">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div class="lg:col-span-2">

                    <div class="mx-auto pt-24 sm:pt-32 mb-8">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-16 lg:grid-cols-2">
                            <div class="rounded-2xl bg-gray-50 p-4 flex items-center justify-between gap-4">
                                <h4 class="text-lg font-semibold leading-7 py-2 text-indigo-600">Цена</h4>
                                <span>{{ $service->prefix }} <b>{{ $service->price }}</b> руб.</span>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4 flex items-center justify-between gap-4">
                                <h4 class="text-lg font-semibold leading-7 py-2 text-indigo-600">Категория</h4>
                                <span>{{ $service->category->name }}</span>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-4 flex items-center justify-between gap-4">
                                <h4 class="text-lg font-semibold leading-7 py-2 text-indigo-600">Просмотров страницы</h4>
                                <span>{{ $service->views }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <h4 class="text-lg font-semibold leading-7 text-indigo-600 px-8 mb-4">Основная информация</h4>
                        <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                            @if ($service->content)
                                {!! $service->content !!}
                            @endif
                        </div>

                        <div class="py-16">
                            <div
                                class="relative isolate overflow-hidden bg-gray-900 px-4 py-24 shadow-2xl sm:rounded-3xl sm:px-24 rounded-xl">
                                <h2
                                    class="mx-auto max-w-2xl text-center text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                    Заказать услугу можно по телефону <br> {{ $company->phones[0] }}
                                </h2>
                                <p class="mx-auto mt-2 max-w-xl text-center text-lg leading-8 text-gray-300"> Оставьте
                                    заявку, и мы свяжемся с вами в ближайшее время </p>
                                <svg viewBox="0 0 1024 1024"
                                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]"
                                    aria-hidden="true">
                                    <circle cx="512" cy="512" r="512"
                                        fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7"></circle>
                                    <defs>
                                        <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                                            <stop stop-color="#7775D6"></stop>
                                            <stop offset="1" stop-color="#E935C1"></stop>
                                        </radialGradient>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="py-24 sm:py-32">
                        <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                            <h3 class="text-base font-semibold leading-7 text-indigo-600">Категории услуг</h3>
                            <dl class="mt-3 space-y-4">
                                @foreach ($categories as $cat)
                                    <div>
                                        <dt class="text-sm font-semibold leading-2 text-indigo-600">
                                            <a href="{{ route('services.category', $cat->slug) }}"
                                                class="flex items-center justify-between">
                                                {{ $cat->name }}
                                                <span class="mdi mdi-chevron-right"></span>
                                            </a>
                                        </dt>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                            <h3 class="text-base font-semibold leading-7 text-indigo-600 mb-2">Посмотрите также</h3>
                            <p class="text-sm leading-4 text-gray-600 mb-4">
                                Посмотрите также другие услуги в категории {{ $category->name }}.
                            </p>
                            <ul class="space-y-4">
                                @foreach ($category->services as $service)
                                    <a href="{{ route('services.show', [
                                        'category' => $category->slug,
                                        'slug' => $service->slug,
                                    ]) }}"
                                        class="flex items-center gap-4">
                                        <li class="flex items-center gap-4">
                                            <img src="{{ Storage::disk('uploads')->url($service->image) }}"
                                                alt="{{ $service->name }}" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h4 class="text-sm font-semibold leading-2 text-indigo-600">
                                                    {{ $service->name }}
                                                </h4>
                                            </div>
                                        </li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
