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

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <!-- Основная информация -->
                <div class="lg:col-span-2">
                    <!-- Районы обслуживания -->
                    <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Зона обслуживания</h3>
                        <div class="mt-6 space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold leading-6 text-gray-900">Районы города:</h4>
                                <p class="mt-2 text-sm leading-6 text-gray-600">{{ implode(', ', $company->serviceAreas) }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold leading-6 text-gray-900">Пригороды:</h4>
                                <p class="mt-2 text-sm leading-6 text-gray-600">{{ implode(', ', $company->suburbs) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Форма обратной связи -->
                    <div class="rounded-2xl bg-white p-8 ring-1 ring-gray-200">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Форма обратной связи</h3>
                        <p class="mt-2 text-lg font-semibold text-gray-900">Свяжитесь с нами</p>
                        <form action="/send-message" method="POST" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Имя</label>
                                <input type="text" id="name" name="name" required 
                                       class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <input type="email" id="email" name="email" required 
                                       class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Сообщение</label>
                                <textarea id="message" name="message" rows="4" required 
                                          class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                            <button type="submit" 
                                    class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
                                Отправить сообщение
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Сайдбар с контактами -->
                <div>
                    <!-- Основная информация -->
                    <div class="rounded-2xl bg-gray-50 p-8 mb-8">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Контактная информация</h3>
                        <dl class="mt-6 space-y-6">
                            <div>
                                <dt class="text-sm font-semibold leading-6 text-gray-900">Адреса:</dt>
                                <dd class="mt-2 space-y-2">
                                    @foreach ($company->addresses as $address)
                                        <div class="flex items-start">
                                            <span class="mdi mdi-map-marker text-indigo-600 mt-1 mr-2"></span>
                                            <span class="text-sm leading-6 text-gray-600">{{ $address }}</span>
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-semibold leading-6 text-gray-900">Телефоны:</dt>
                                <dd class="mt-2 space-y-2">
                                    @foreach ($company->phones as $phone)
                                        <div class="flex items-center">
                                            <span class="mdi mdi-phone text-indigo-600 mr-2"></span>
                                            <a href="tel:{{ $phone }}" class="text-sm leading-6 text-gray-600 hover:text-indigo-600 transition-colors">
                                                {{ $phone }}
                                            </a>
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-semibold leading-6 text-gray-900">Email:</dt>
                                <dd class="mt-2 space-y-2">
                                    @foreach ($company->emails as $email)
                                        <div class="flex items-center">
                                            <span class="mdi mdi-email text-indigo-600 mr-2"></span>
                                            <a href="mailto:{{ $email }}" class="text-sm leading-6 text-gray-600 hover:text-indigo-600 transition-colors">
                                                {{ $email }}
                                            </a>
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Юридическая информация -->
                    <div class="rounded-2xl bg-white p-8 ring-1 ring-gray-200">
                        <h3 class="text-base font-semibold leading-7 text-indigo-600">Юридическая информация</h3>
                        <div class="mt-6 space-y-8">
                            @foreach ($company->legals as $legal)
                                <div class="space-y-4">
                                    <div>
                                        <dt class="text-sm font-semibold leading-6 text-gray-900">Основная информация</dt>
                                        <dd class="mt-2 text-sm leading-6 text-gray-600">
                                            <div class="space-y-2">
                                                <p><span class="font-medium">Название:</span> {{ $legal->name }}</p>
                                                <p><span class="font-medium">ИНН:</span> {{ $legal->inn }}</p>
                                                <p><span class="font-medium">КПП:</span> {{ $legal->kpp }}</p>
                                            </div>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-semibold leading-6 text-gray-900">Банковские реквизиты</dt>
                                        <dd class="mt-2 text-sm leading-6 text-gray-600">
                                            <div class="space-y-2">
                                                <p><span class="font-medium">Банк:</span> {{ $legal->bank }}</p>
                                                <p><span class="font-medium">БИК:</span> {{ $legal->bik }}</p>
                                                <p><span class="font-medium">Номер счета:</span> {{ $legal->account_number }}</p>
                                                <p><span class="font-medium">Корр. счет:</span> {{ $legal->correspondent_account }}</p>
                                            </div>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-semibold leading-6 text-gray-900">Адрес</dt>
                                        <dd class="mt-2 text-sm leading-6 text-gray-600">
                                            {{ $legal->legal_address }}
                                        </dd>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
