@extends('layouts.main')
@section('title', $category->name . ' | Услуги')
@section('description', $category->description)

@section('content')
    <x-hero-banner title="{{ $category->name }}" description="{{ $category->description }}" :breadcrumbs="[['title' => $category->name, 'url' => '/services']]">
    </x-hero-banner>


    <!-- Поиск -->

    <search-component type="desktop"></search-component>

    <div class="pb-24 sm:pb-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <!-- Основная информация -->
                <div class="lg:col-span-2">
                    <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-2">
                            @foreach ($category->services as $service)
                                <x-service-card :service="$service"></x-service-card>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Сайдбар с контактами -->
                <div>
                    <!-- Основная информация -->
                    <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Категории услуг</h3>
                        <dl class="mt-3 space-y-4">
                            @foreach ($categories as $category)
                                <div>
                                    <dt class="text-sm font-semibold leading-2 text-indigo-600">
                                        <a href="{{ route('services.category', $category->slug) }}"
                                            class="flex items-center justify-between">
                                            {{ $category->name }}
                                            <span class="mdi mdi-chevron-right"></span>
                                        </a>
                                    </dt>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Бесплатная консультация</h3>
                        <p class="text-sm leading-4 text-gray-600">
                            Оставьте заявку на бесплатную консультацию, и мы свяжемся с вами в течение 15 минут.
                        </p>
                        <form action="" class="space-y-4 mt-4">
                            <input type="text" name="name" placeholder="Имя"
                                class="w-full p-2 rounded-md border border-gray-300">
                            <input type="text" name="phone" placeholder="Телефон"
                                class="w-full p-2 rounded-md border border-gray-300">
                            <input type="text" name="email" placeholder="Email"
                                class="w-full p-2 rounded-md border border-gray-300">
                            <textarea name="message" placeholder="Сообщение" class="w-full p-2 rounded-md border border-gray-300"></textarea>
                            <button type="submit" class="w-full p-2 rounded-md bg-indigo-600 text-white">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
