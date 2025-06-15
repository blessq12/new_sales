@extends('layouts.main')
@section('title', 'Прайс-лист')
@section('description',
    'Полный прайс лист по услугам, которые мы предоставляем, также вы можете скачать его в формате
    PDF')
@section('keywords', 'прайс-лист, услуги, цены, прайс, прайс лист, прайс лист ооо салес, прайс лист ооо салес на ' .
    date('Y') . ' год')
@section('content')
    <x-hero-banner :title="'Прайс-лист'"
        description="Полный прайс лист по услугам, которые мы предоставляем, также вы можете скачать его в формате PDF"
        :breadcrumbs="[['title' => 'Прайс-лист', 'url' => '/services/price']]"></x-hero-banner>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12">
        <div class="md:flex justify-between items-center mb-8 block space-y-4 md:space-y-0">
            <h1 class="text-2xl font-bold ">Прайс-лист</h1>
            <a href="{{ route('services.price.download') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-xl flex items-center justify-center">
                <i class="mdi mdi-download me-2"></i>
                Скачать прайс-лист
            </a>
        </div>
        <div class="overflow-x-auto">


            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Услуга</th>
                        <th scope="col" class="px-6 py-3">Описание</th>
                        <th scope="col" class="px-6 py-3 w-48 whitespace-nowrap">Цена</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-gray-800">
                            <th scope="row" colspan="3" class="px-6 py-4 font-medium text-white">
                                {{ $category->name }}
                            </th>
                        </tr>
                        @foreach ($category->services as $service)
                            <tr class="border-b bg-gray-100">
                                <td class="px-6 py-4 text-gray-900">{{ $service->name }}</td>
                                <td class="px-6 py-4 text-gray-900">{{ $service->description }}</td>
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap w-48">{{ $service->prefix }}
                                    {{ $service->price }} ₽</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
