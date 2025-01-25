@extends('layouts.main')
@section('title', 'Профессиональные сантехники в Томске - Ваш надежный помощник!')
@section('description', 'Ищете качественные услуги сантехников в Томске? Мы предлагаем профессиональные решения для вашего дома. Звоните: 226-224')
@section('content')
    
    <div class="py-5 h-100 container-fluid position-relative" style="background: url({{ Storage::disk('assets')->url('images/bg1.jpg') }}) no-repeat center center; background-size: cover;">
        <div class="overlay" style="
            background-color: rgba(0, 0, 0, 0.7);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        "></div>
        <div class="container text-light position-relative py-5">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12">
                    <h5 class="mb-0 lh-1">Качественные услуги сантехников в Томске - мы здесь, чтобы помочь!</h5>
                    <h1 class="fw-bold display-4">Ваши сантехнические проблемы - наша забота!</h1>
                    <p class="lead">Звоните нам: 
                        <a href="{{ $company->phones[0] }}" class="fw-bold">{{ $company->phones[0] }}</a>
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="btn btn-warning btn-lg">Получить консультацию</a>
                        <a href="{{ route('main.contacts') }}" class="btn btn-outline-light btn-lg">Контакты</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold">Почему выбирают нас?</h2>
            <hr class="w-25 mb-4">
            @php
                $advantages = [
                    ['title' => 'Профессионалы', 'text' => 'Каждый наш мастер - эксперт в своей области.', 'icon' => 'bi bi-person-check'],
                    ['title' => 'Соблюдение сроков', 'text' => 'Мы всегда выполняем обещания по срокам.', 'icon' => 'bi bi-clock'],
                    ['title' => 'Быстрый выезд', 'text' => 'Приедем точно в назначенное время, когда это важно.', 'icon' => 'bi bi-car-front'],
                    ['title' => 'Контроль качества', 'text' => 'Поддерживаем связь с клиентами даже после завершения работ.', 'icon' => 'bi bi-check-circle'],
                    ['title' => 'Примеры работ', 'text' => 'Вы можете увидеть наши выполненные проекты.', 'icon' => 'bi bi-house'],
                    ['title' => 'Помощь в покупках', 'text' => 'Поможем с выбором и доставкой материалов.', 'icon' => 'bi bi-cart'],
                    ['title' => 'Надежность', 'text' => 'Мы - реальная компания с офисом и постоянными мастерами.', 'icon' => 'bi bi-building'],
                    ['title' => 'Гарантия 100%', 'text' => 'Даем 2 года гарантии на все виды работ.', 'icon' => 'bi bi-shield-check'],
                ];
            @endphp
            <div class="row">
                @foreach($advantages as $advantage)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-row">
                                <i class="{{ $advantage['icon'] }} fs-2 fw-bold me-3"></i>
                                <div class="d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $advantage['title'] }}</h5>
                                    <p class="card-text mb-0">{{ $advantage['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <h2 class="fw-bold">Услуги, которые мы предлагаем</h2>
            <hr class="w-25 mb-4">
        </div>
    </section>
@endsection
