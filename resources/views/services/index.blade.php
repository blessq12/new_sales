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
    <section class="pt-20 pb-8">
        <div class="container mx-auto">
            <h3 class="text-2xl font-bold mb-4">Поиск услуги</h3>
            <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Поиск услуги">
        </div>
    </section>
    <section class="pb-20">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <x-service-card :service="$service"></x-service-card>
                @endforeach
            </div>
        </div>
    </section>
@endsection
