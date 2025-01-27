@extends('layouts.main')
@section('title', 'Услуги')
@section('description', 'Узнайте о наших услугах, которые помогут вам решить задачи и достичь результатов. Выберите подходящее решение для вас.')

@section('content')
    <x-hero-banner
        image="https://images.ctfassets.net/ihx0a8chifpc/GTlzd4xkx4LmWsG1Kw1BB/ad1834111245e6ee1da4372f1eb5876c/placeholder.com-1280x720.png?w=1920&q=60&fm=webp"
        title="Услуги"
        description="Узнайте о наших услугах, которые помогут решить ваши задачи и достичь результатов. Выберите подходящее решение для вас."
        :breadcrumbs="[
            ['title' => 'Услуги', 'url' => route('services')],
        ]"
    ></x-hero-banner>

    <!-- Поиск -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12">
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="mdi mdi-magnify text-gray-400 text-xl"></span>
            </div>
            <input type="text" 
                   class="block w-full rounded-xl border-0 py-4 pl-12 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                   placeholder="Поиск услуги...">
        </div>
    </div>

    <!-- Список услуг -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @foreach($services as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>
    </div>

    <!-- CTA секция -->
    <div class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                <div class="max-w-xl lg:max-w-lg">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Не нашли нужную услугу?</h2>
                    <p class="mt-4 text-lg leading-8 text-gray-300">
                        Оставьте заявку на нашем сайте, и мы свяжемся с вами в течение 15 минут. Мы готовы помочь вам найти решение, которое соответствует вашим потребностям.
                    </p>
                    <div class="mt-6 flex max-w-md gap-x-4">
                        <button class="flex-none rounded-xl bg-indigo-500 px-8 py-4 text-base font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition-all duration-200">
                            Оставить заявку
                        </button>
                    </div>
                </div>
                <dl class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
                    <div class="flex flex-col items-start">
                        <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                            <span class="mdi mdi-clock-fast text-2xl text-white"></span>
                        </div>
                        <dt class="mt-4 font-semibold text-white">Быстрый ответ</dt>
                        <dd class="mt-2 leading-7 text-gray-400">Мы свяжемся с вами в течение 15 минут после получения заявки</dd>
                    </div>
                    <div class="flex flex-col items-start">
                        <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                            <span class="mdi mdi-account-check text-2xl text-white"></span>
                        </div>
                        <dt class="mt-4 font-semibold text-white">Профессиональная консультация</dt>
                        <dd class="mt-2 leading-7 text-gray-400">Наши специалисты помогут подобрать оптимальное решение</dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-30"></div>
        </div>
    </div>
@endsection
