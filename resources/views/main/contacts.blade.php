@extends('layouts.main')

@section('title', 'Контакты')
@section('description', 'Контакты компании ООО "Салес"')

@section('content')
    <x-hero-banner
        :image="'https://www.sales-tomsk.ru/images/dest/bg3.jpg'"
        title="Контакты"
        description='Контакты компании ООО "Салес"'
        :breadcrumbs="[
            ['title' => 'Контакты', 'url' => '/contacts']
        ]"
    ></x-hero-banner>
    <section class="py-20">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-2">
                <h3 class="text-2xl font-bold mb-4">Юридическая информация</h3>
                
                <p class="mb-4">
                    <b>Районы города которые мы обслуживаем:</b>
                    {{ implode(', ', $company->serviceAreas) }}
                </p>
                <p class="mb-4">
                    <b>А также пригорода:</b>
                    {{ implode(', ', $company->suburbs) }}
                </p>
                
                <h3 class="text-2xl font-bold mb-4">Форма обратной связи</h3>
                <form action="/send-message" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Сообщение</label>
                        <textarea id="message" name="message" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить</button>
                </form>
            </div>
            <div class="col-span-1">
                <h3 class="text-2xl font-bold mb-4">Основная информация о компании</h3>
                <div class="border p-4 rounded-lg mb-4">
                    <p>
                        <b>Адреса:</b>
                        @foreach ($company->addresses as $address)
                            <p>
                                <i class="mdi mdi-map-marker"></i>
                                {{ $address }}
                            </p>
                        @endforeach
                    </p>
                    <p>
                        <b>Телефоны:</b>
                        @foreach ($company->phones as $phone)
                            <p>
                                <i class="mdi mdi-phone"></i>
                                {{ $phone }}
                            </p>
                        @endforeach
                    </p>
                    <p>
                        <b>Email:</b>
                        @foreach ($company->emails as $email)
                            <p>
                                <i class="mdi mdi-email"></i>
                                {{ $email }}
                            </p>
                        @endforeach
                    </p>
                </div>
                <h3 class="text-2xl font-bold mb-4">Юридическая информация</h3>
                @foreach ($company->legals as $legal)
                    <div class="border p-4 rounded-lg mb-4">
                        
                            <p><b>Номер счета:</b> {{ $legal->account_number }}</p>
                            <p><b>Валюта:</b> {{ $legal->currency }}</p>
                            <p><b>Название:</b> {{ $legal->name }}</p>
                            <p><b>ИНН:</b> {{ $legal->inn }}</p>
                            <p><b>КПП:</b> {{ $legal->kpp }}</p>
                            <p><b>Банк:</b> {{ $legal->bank }}</p>
                            <p><b>БИК:</b> {{ $legal->bik }}</p>
                            <p><b>Корреспондентский счет:</b> {{ $legal->correspondent_account }}</p>
                            <p><b>Юридический адрес:</b> {{ $legal->legal_address }}</p>
                        
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
