@extends('layouts.main')

@section('title', 'О нас')
@section('description', 'Узнайте о нашей компании, миссии и ценностях. Мы предоставляем высококачественные решения для удовлетворения потребностей клиентов.')

@section('content')
    <x-hero-banner
        :image="'https://www.sales-tomsk.ru/images/dest/bg3.jpg'"
        :title="'О нас'"
        :description="'Узнайте о нашей компании, миссии и ценностях. Мы предоставляем высококачественные решения для удовлетворения потребностей клиентов.'"
        :breadcrumbs="[
            ['title' => 'О нас', 'url' => '/about']
        ]"
    ></x-hero-banner>

    <!-- История компании -->
    <div class="relative isolate overflow-hidden bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">История ООО "Салес"</h2>
                <div class="relative mt-16">
                    <figure class="border-l border-indigo-600 pl-8">
                        <blockquote class="text-xl font-semibold leading-8 tracking-tight text-gray-900">
                            <p>"Я Сидякин Алексей Викторович, директор компании ООО "Салес". Хотелось бы вам рассказать историю о том, как я пришёл к своему бизнесу..."</p>
                        </blockquote>
                        <figcaption class="mt-8 flex gap-x-4">
                            <img src="https://www.sales-tomsk.ru/images/dest/photo.jpg" alt="Директор компании" class="mt-1 h-12 w-12 flex-none rounded-full bg-gray-50 object-cover">
                            <div class="text-sm leading-6">
                                <div class="font-semibold text-gray-900">Алексей Сидякин</div>
                                <div class="text-gray-600">Директор ООО "Салес"</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- История успеха -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col justify-between">
                    <div class="rounded-2xl bg-gray-50 p-8">
                        <time datetime="2008" class="text-sm leading-6 text-gray-600">2008</time>
                        <h3 class="mt-4 text-lg font-semibold leading-8 tracking-tight text-gray-900">Начало пути</h3>
                        <p class="mt-4 text-base leading-7 text-gray-600">
                            В 2008 году, закончив Томский Политехнический Университет, я задался вопросом: где? как? и за сколько? Работать. Как и у всех специалистов, магистров выпускающихся из университета, у меня была полная уверенность, что нас с руками и ногами должны расхватывать по компаниям.
                        </p>
                    </div>
                    <div class="flex items-center gap-x-4 mt-8">
                        <div class="h-px flex-auto bg-gray-100"></div>
                        <span class="mdi mdi-school text-2xl text-indigo-600"></span>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                </div>

                <div class="flex flex-col justify-between">
                    <div class="rounded-2xl bg-gray-50 p-8">
                        <time datetime="2008" class="text-sm leading-6 text-gray-600">2008-2009</time>
                        <h3 class="mt-4 text-lg font-semibold leading-8 tracking-tight text-gray-900">Поиск своего пути</h3>
                        <p class="mt-4 text-base leading-7 text-gray-600">
                            Работодатели проявляют особые требования к своим рабочим. У них должен быть опыт, знания, умения, практика те которые нужны сегодня! Да и те которые по большому счёту в университетах не предоставляют!
                        </p>
                    </div>
                    <div class="flex items-center gap-x-4 mt-8">
                        <div class="h-px flex-auto bg-gray-100"></div>
                        <span class="mdi mdi-briefcase-search text-2xl text-indigo-600"></span>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                </div>

                <div class="flex flex-col justify-between">
                    <div class="rounded-2xl bg-gray-50 p-8">
                        <time datetime="2023" class="text-sm leading-6 text-gray-600">Сегодня</time>
                        <h3 class="mt-4 text-lg font-semibold leading-8 tracking-tight text-gray-900">ООО "Салес"</h3>
                        <p class="mt-4 text-base leading-7 text-gray-600">
                            Сегодня ООО "Салес" - это профессиональная команда специалистов, предоставляющая качественные услуги в Томске и области. Мы гордимся нашей репутацией и постоянно развиваемся.
                        </p>
                    </div>
                    <div class="flex items-center gap-x-4 mt-8">
                        <div class="h-px flex-auto bg-gray-100"></div>
                        <span class="mdi mdi-trophy text-2xl text-indigo-600"></span>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Наша команда -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Наша команда</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Мы гордимся нашими специалистами, которые ежедневно делают жизнь наших клиентов лучше.
                </p>
            </div>
            <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <li>
                    <img class="aspect-[3/2] w-full rounded-2xl object-cover" src="https://www.sales-tomsk.ru/images/dest/team1.jpg" alt="">
                    <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Алексей Сидякин</h3>
                    <p class="text-base leading-7 text-gray-600">Директор</p>
                </li>
                <li>
                    <img class="aspect-[3/2] w-full rounded-2xl object-cover" src="https://www.sales-tomsk.ru/images/dest/team2.jpg" alt="">
                    <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Иван Петров</h3>
                    <p class="text-base leading-7 text-gray-600">Главный инженер</p>
                </li>
                <li>
                    <img class="aspect-[3/2] w-full rounded-2xl object-cover" src="https://www.sales-tomsk.ru/images/dest/team3.jpg" alt="">
                    <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">Сергей Иванов</h3>
                    <p class="text-base leading-7 text-gray-600">Ведущий специалист</p>
                </li>
            </ul>
        </div>
    </div>

    <!-- CTA секция -->
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Начните работать с нами сегодня
                </h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                    Мы готовы помочь вам с любыми задачами. Наши специалисты обеспечат качественное выполнение работ в срок.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('main.contacts') }}" 
                       class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Связаться с нами
                    </a>
                    <a href="{{ route('services') }}" class="text-sm font-semibold leading-6 text-white">
                        Наши услуги <span aria-hidden="true">→</span>
                    </a>
                </div>
                <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
@endsection
