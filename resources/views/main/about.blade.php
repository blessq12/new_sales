@extends('layouts.main')

@section('title', 'О нас')
@section('description',
    'Узнайте о нашей компании, миссии и ценностях. Мы предоставляем высококачественные решения для
    удовлетворения потребностей клиентов.')

@section('content')
    <x-hero-banner :title="'О нас'" :description="'Узнайте о нашей компании, миссии и ценностях. Мы предоставляем высококачественные решения для удовлетворения потребностей клиентов.'" :breadcrumbs="[['title' => 'О нас', 'url' => '/about']]"></x-hero-banner>

    <div class="relative isolate overflow-hidden bg-gradient-to-b from-gray-50 to-white py-24 sm:py-32">
        <div class="absolute inset-0">
            <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-indigo-50 to-transparent"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl mb-6">История ООО "Салес"</h2>
                    <div class="space-y-6">
                        <blockquote class="text-xl font-medium leading-8 text-gray-900 border-l-4 border-indigo-600 pl-6">
                            <p>"Я Сидякин Алексей Викторович, директор компании ООО "Салес". За 15 лет мы прошли путь от
                                небольшой команды до одного из ведущих предприятий в области сантехнических услуг."</p>
                        </blockquote>
                        <div class="prose prose-lg prose-indigo">
                            <p class="text-gray-600">Под моим руководством компания достигла значительных успехов в
                                предоставлении
                                высококачественных услуг по прочистке канализаций и сантехническим работам. Мы
                                гордимся тем, что помогаем нашим клиентам решать их проблемы быстро и эффективно.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-600">15+</div>
                                <div class="text-sm text-gray-600 mt-1">Лет опыта</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-600">5000+</div>
                                <div class="text-sm text-gray-600 mt-1">Довольных клиентов</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative lg:ml-12">
                    <div class="aspect-[4/5] relative">
                        <img src="/assets/images/director.jpeg" alt="Директор компании"
                            class="absolute inset-0 w-full h-full object-cover rounded-2xl shadow-2xl">
                        <div class="absolute inset-0 ring-1 ring-inset ring-gray-900/10 rounded-2xl"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-6 max-w-sm">
                        <div class="flex items-center space-x-4">
                            <div class="rounded-full bg-indigo-600/10 p-3">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Образование</h3>
                                <p class="text-sm text-gray-600">Томский Политехнический Университет</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col justify-between">
                    <div class="rounded-2xl bg-gray-50 p-8">
                        <time datetime="2008" class="text-sm leading-6 text-gray-600">2008</time>
                        <h3 class="mt-4 text-lg font-semibold leading-8 tracking-tight text-gray-900">Начало пути</h3>
                        <p class="mt-4 text-base leading-7 text-gray-600">
                            В 2008 году, закончив Томский Политехнический Университет, я задался вопросом: где? как? и за
                            сколько? Работать. Как и у всех специалистов, магистров выпускающихся из университета, у меня
                            была полная уверенность, что нас с руками и ногами должны расхватывать по компаниям.
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
                            Работодатели проявляют особые требования к своим рабочим. У них должен быть опыт, знания,
                            умения, практика те которые нужны сегодня! Да и те которые по большому счёту в университетах не
                            предоставляют!
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
                            Сегодня ООО "Салес" - это профессиональная команда специалистов, предоставляющая качественные
                            услуги в Томске и области. Мы гордимся нашей репутацией и постоянно развиваемся.
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


    <div class="bg-gray-50 pt-24 sm:pt-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8lg:mx-0 mb-10">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Наши сертификаты</h2>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Сертификаты, которые мы представляем, являются не только подтверждением качества нашей продукции, но и
                свидетельством нашего профессионализма и приверженности высоким стандартам.
            </p>
        </div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 sm:grid-cols-3 lg:mx-0 lg:max-w-none lg:grid-cols-6">
                @foreach ($files as $file)
                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:shadow-xl">
                        <div class="aspect-h-4 aspect-w-3 relative min-h-60"
                            style="background-image: url('{{ '/assets/images/docs/' . $file }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            <div
                                class="bg-black/10 absolute inset-0 flex items-center justify-center group-hover:bg-black/30 transition-all duration-300">
                                <a href="{{ '/assets/images/docs/' . $file }}" target="_blank"
                                    class="rounded-full bg-white px-2 py-1 title-underline transform transition-all duration-300 group-hover:scale-150">
                                    <i class="mdi mdi-eye text-xl text-gray-900"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Наша команда -->
    {{-- <div class="bg-gray-50 py-24 sm:py-32">
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
    </div> --}}

    <!-- Информация о компании -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Почему выбирают нас</h2>
            <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Опыт работы</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">ООО «Салес» на рынке работает больше 11 лет.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Проверенные мастера</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Все работы выполняют проверенные мастера с опытом
                        работы.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Бесплатный выезд</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Выезд мастера бесплатный в пределах города.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Гибкие скидки</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Гибкая система скидок, от объема.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Выгодные условия</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Готовы торговаться и дать более выгодные условия.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Гарантия</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">☛ Даем гарантию 2 года на все выполненные работы.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Консультация</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Консультация бесплатно. Звонить с 8.00 до 23.00 без
                        выходных.</p>
                </div>
                <div class="rounded-2xl bg-white p-8 shadow-md">
                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">Связь</h3>
                    <p class="mt-4 text-base leading-7 text-gray-600">Отвечу на любые вопросы лично или по ☏ телефону.</p>
                </div>
            </div>
        </div>
    </div>
    <x-front-cta />
@endsection
