@extends('layouts.main')

@section('title', 'Галерея')
@section('description', 'Галерея представляет собой визуальное отражение нашей работы и достижений. Здесь вы найдете тщательно отобранные фотографии и материалы, которые демонстрируют наши проекты, мероприятия и инициативы. Мы стремимся к высокому качеству и инновациям, и эта галерея служит свидетельством нашего профессионализма и преданности делу.')

@section('content')
    <x-hero-banner
        :image="'https://www.sales-tomsk.ru/images/dest/bg3.jpg'"
        :title="'О нас'"
        :description="'Узнайте о нашей компании, миссии и ценностях. Мы предоставляем высококачественные решения для удовлетворения потребностей клиентов.'"
        :breadcrumbs="[
            ['title' => 'Галерея', 'url' => '/gallery']
        ]"
    ></x-hero-banner>
@endsection