@extends('layouts.main')
@section('title', 'Отзывы')
@section('description',
    'Узнайте о наших отзывах, которые помогут вам решить задачи и достичь результатов. Выберите
    подходящее решение для вас.')
@section('keywords',
    'отзывы, отзывы о нас, отзывы о наших услугах, прочистка, прочистка канализации, прочистка труб,
    прочистка труб в Москве, прочистка труб, сантехнические работы, сантехнические услуги, сантехнические услуги в Москве,
    сантехнические услуги в Москве, сантехнические услуги в Москве, сантехнические услуги в Москве')
@section('content')
    <x-hero-banner title="Отзывы"
        description="Узнайте о наших отзывах, которые помогут решить задачи и достичь результатов. Выберите подходящее решение для вас."
        :breadcrumbs="[['title' => 'Отзывы', 'url' => route('reviews.index')]]">
    </x-hero-banner>

    <!-- Список услуг -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-24">
        <div class="mb-6">
            <button @click="openModal('review')"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                <span class="mdi mdi-plus-circle mr-2"></span>
                Оставьте новый отзыв
            </button>
        </div>
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @foreach ($reviews as $review)
                <x-review-card :review="$review" />
            @endforeach
        </div>
    </div>
    @if ($reviews->hasPages())
        <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
            {{ $reviews->links() }}
        </div>
    @endif

@endsection
