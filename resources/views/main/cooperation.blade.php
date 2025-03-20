@extends('layouts.main')
@section('title', 'Надежное и профессиональное обслуживание ваших инженерных систем')
@section('description',
    'Обеспечиваем бесперебойную работу канализации и водоснабжения. Оперативно, качественно, по
    договору.')
@section('keywords', 'канализация, водоснабжение, обслуживание, ремонт, монтаж, проектирование, строительство')
@section('content')
    <x-hero-banner title="Сотрудничество"
        description="Сотрудничество с нами - это возможность для вас получить выгодные условия и лучшие условия для вашего бизнеса."
        :breadcrumbs="[['title' => 'Сотрудничество', 'url' => route('main.cooperation')]]">
    </x-hero-banner>


    <div class="relative bg-white py-24 sm:py-32 overflow-hidden">

        <div class="absolute -top-24 right-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
            <div class="aspect-[1404/767] w-[87.75rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25"
                style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)">
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-sm font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 mb-6">
                    Преимущества
                </span>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Почему выгодно работать с нами?</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Мы предлагаем комплексный подход к обслуживанию инженерных систем
                </p>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <div
                    class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <div class="relative">
                        <div class="flex items-center gap-x-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600/10">
                                <span class="mdi mdi-clock-fast text-2xl text-indigo-600"></span>
                            </div>
                            <h3 class="text-lg font-semibold leading-8 text-gray-900">Быстрое реагирование</h3>
                        </div>
                        <p class="mt-4 text-base leading-7 text-gray-600">Гарантированная скорость реагирования – аварийные
                            заявки обрабатываются в кратчайшие сроки.</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <div class="relative">
                        <div class="flex items-center gap-x-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600/10">
                                <span class="mdi mdi-cash-multiple text-2xl text-indigo-600"></span>
                            </div>
                            <h3 class="text-lg font-semibold leading-8 text-gray-900">Экономия на ремонте</h3>
                        </div>
                        <p class="mt-4 text-base leading-7 text-gray-600">Снижение затрат на ремонт – регулярное
                            обслуживание предотвращает серьезные поломки.</p>
                    </div>
                </div>
                <div
                    class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <div class="relative">
                        <div class="flex items-center gap-x-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-600/10">
                                <span class="mdi mdi-certificate text-2xl text-indigo-600"></span>
                            </div>
                            <h3 class="text-lg font-semibold leading-8 text-gray-900">Профессионализм</h3>
                        </div>
                        <p class="mt-4 text-base leading-7 text-gray-600">Квалифицированные специалисты – сертифицированное
                            оборудование, профессиональный подход.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- stage --}}
    {{-- <div class="relative bg-gray-50 py-24 sm:py-32 overflow-hidden">

        <div class="absolute -top-24 left-0 -z-10 transform-gpu blur-3xl" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-sm font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 mb-6">
                    Этапы
                </span>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Как начать сотрудничество</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Простой процесс оформления договора
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-5xl">
                <!-- Мобильная версия (до md) -->
                <div class="md:hidden space-y-8">
                    <!-- Шаг 1 -->
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="p-6 relative">
                            <div class="absolute -top-6 -right-6 w-16 h-16 bg-indigo-100 rounded-full"></div>
                            <div class="flex gap-4 items-start relative z-10">
                                <div
                                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-600 text-white rounded-full text-xl font-bold shadow-md">
                                    1</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Оставьте заявку</h3>
                                    <p class="text-gray-600">Свяжитесь с нами любым удобным способом - по телефону или через
                                        форму на сайте</p>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 text-indigo-200">
                                <span class="mdi mdi-phone-in-talk text-4xl"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Шаг 2 -->
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="p-6 relative">
                            <div class="absolute -top-6 -right-6 w-16 h-16 bg-indigo-100 rounded-full"></div>
                            <div class="flex gap-4 items-start relative z-10">
                                <div
                                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-600 text-white rounded-full text-xl font-bold shadow-md">
                                    2</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Определим объем работ</h3>
                                    <p class="text-gray-600">Наши специалисты оценят объект и составят детальный план
                                        необходимых работ</p>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 text-indigo-200">
                                <span class="mdi mdi-clipboard-list text-4xl"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Шаг 3 -->
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="p-6 relative">
                            <div class="absolute -top-6 -right-6 w-16 h-16 bg-indigo-100 rounded-full"></div>
                            <div class="flex gap-4 items-start relative z-10">
                                <div
                                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-600 text-white rounded-full text-xl font-bold shadow-md">
                                    3</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Подготовим договор</h3>
                                    <p class="text-gray-600">Согласуем все условия сотрудничества и подпишем договор</p>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 text-indigo-200">
                                <span class="mdi mdi-file-document text-4xl"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Шаг 4 -->
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
                        <div class="p-6 relative">
                            <div class="absolute -top-6 -right-6 w-16 h-16 bg-indigo-100 rounded-full"></div>
                            <div class="flex gap-4 items-start relative z-10">
                                <div
                                    class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-600 text-white rounded-full text-xl font-bold shadow-md">
                                    4</div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Начинаем работу</h3>
                                    <p class="text-gray-600">Приступаем к обслуживанию по согласованному графику</p>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 text-indigo-200">
                                <span class="mdi mdi-check-circle text-4xl"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Десктопная версия (md и больше) -->
                <div class="hidden md:block relative">
                    <!-- Центральная линия -->
                    <div class="absolute left-1/2 h-full w-1 -translate-x-1/2 bg-indigo-100 rounded-full overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-indigo-100 via-indigo-500 to-indigo-100 animate-pulse">
                        </div>
                    </div>

                    <!-- Шаг 1 -->
                    <div class="relative flex items-center mb-20 group">
                        <div class="w-1/2 pr-12 text-right">
                            <div
                                class="bg-white p-6 rounded-xl shadow-md inline-block hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Оставьте заявку</h3>
                                <p class="text-gray-600">Свяжитесь с нами любым удобным способом - по телефону или через
                                    форму на сайте</p>
                            </div>
                        </div>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center border-4 border-indigo-100 z-10 group-hover:scale-110 transition-transform duration-300">
                            <span class="mdi mdi-phone-in-talk text-2xl text-indigo-600"></span>
                        </div>
                        <div class="w-1/2 pl-12"></div>
                    </div>

                    <!-- Шаг 2 -->
                    <div class="relative flex items-center mb-20 group">
                        <div class="w-1/2 pr-12"></div>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center border-4 border-indigo-100 z-10 group-hover:scale-110 transition-transform duration-300">
                            <span class="mdi mdi-clipboard-list text-2xl text-indigo-600"></span>
                        </div>
                        <div class="w-1/2 pl-12">
                            <div
                                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Определим объем работ</h3>
                                <p class="text-gray-600">Наши специалисты оценят объект и составят детальный план
                                    необходимых работ</p>
                            </div>
                        </div>
                    </div>

                    <!-- Шаг 3 -->
                    <div class="relative flex items-center mb-20 group">
                        <div class="w-1/2 pr-12 text-right">
                            <div
                                class="bg-white p-6 rounded-xl shadow-md inline-block hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Подготовим договор</h3>
                                <p class="text-gray-600">Согласуем все условия сотрудничества и подпишем договор</p>
                            </div>
                        </div>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center border-4 border-indigo-100 z-10 group-hover:scale-110 transition-transform duration-300">
                            <span class="mdi mdi-file-document text-2xl text-indigo-600"></span>
                        </div>
                        <div class="w-1/2 pl-12"></div>
                    </div>

                    <!-- Шаг 4 -->
                    <div class="relative flex items-center group">
                        <div class="w-1/2 pr-12"></div>
                        <div
                            class="absolute left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-white shadow-md flex items-center justify-center border-4 border-indigo-100 z-10 group-hover:scale-110 transition-transform duration-300">
                            <span class="mdi mdi-check-circle text-2xl text-indigo-600"></span>
                        </div>
                        <div class="w-1/2 pl-12">
                            <div
                                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Начинаем работу</h3>
                                <p class="text-gray-600">Приступаем к обслуживанию по согласованному графику</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 flex justify-center">
                    <a href="{{ route('main.contacts') }}"
                        class="group inline-flex items-center gap-x-2 rounded-full bg-indigo-600 px-8 py-4 text-base font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-300">
                        Оставить заявку на странице "Контакты"
                        <span
                            class="mdi mdi-arrow-right text-xl transition-transform duration-300 group-hover:translate-x-1"></span>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- end stage --}}

    {{-- services --}}
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-sm font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 mb-6">
                    Услуги
                </span>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Какие работы мы выполняем</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Полный спектр услуг по обслуживанию инженерных систем
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-7xl">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-pipe-wrench text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Прочистка и устранение засоров</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Внутренней и внешней канализации, стояков, колодцев</p>
                        </div>
                    </div>


                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-tools text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Профилактическое обслуживание</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Регулярная промывка труб, гидродинамическая и
                                механическая очистка</p>
                        </div>
                    </div>


                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-alert-circle text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Аварийные работы</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Срочное устранение протечек, засоров, прорывов труб</p>
                        </div>
                    </div>


                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-camera text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Диагностика и мониторинг</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Видеоинспекция труб, выявление дефектов и слабых
                                мест
                            </p>
                        </div>
                    </div>


                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-pipe text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Ремонт и замена сантехники</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Трубопроводов, стояков, водопроводных сетей,
                                арматуры
                            </p>
                        </div>
                    </div>


                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-pump text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Обслуживание насосных станций</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Проверка, чистка, ремонт оборудования</p>
                        </div>
                    </div>
                </div>


                <div class="mt-16">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="flex items-center space-x-2 text-indigo-600">
                            <span class="mdi mdi-information text-xl"></span>
                            <p class="text-lg font-medium">Диспетчеризация и отчетность</p>
                        </div>
                        <p class="text-center text-gray-600">Фиксация заявок, предоставление отчетов о выполненных
                            работах
                        </p>
                        <div class="mt-4 rounded-xl bg-gray-50 p-6 text-center">
                            <p class="text-sm text-gray-600">Условия, объем работ и сроки прописываются в договоре
                                индивидуально</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="relative bg-indigo-50 py-24 sm:py-32 overflow-hidden">

        <div class="absolute top-0 right-0 -z-10 transform-gpu blur-3xl opacity-20" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#9089fc] to-[#4f46e5]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="absolute bottom-0 left-0 -z-10 transform-gpu blur-3xl opacity-20" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#4f46e5] to-[#80caff]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">
                <span
                    class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-sm font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 mb-6">
                    шаги для сотрудничества
                </span>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-6">Как <span
                        class="relative inline-block">
                        <span class="relative z-10">начать</span>
                        <div class="absolute bottom-2 w-full h-3 bg-indigo-200 -z-10"></div>
                    </span> сотрудничество</h2>
                <p class="mt-4 text-xl leading-8 text-gray-600 max-w-xl mx-auto">
                    Простой и понятный процесс оформления договора
                </p>
            </div>

            <div class="mx-auto mt-20 max-w-6xl">
                <div class="hidden lg:block absolute left-1/2 h-full w-0.5 -translate-x-1/2 bg-indigo-600"></div>
                <div class="space-y-12 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-12">

                    <div
                        class="col-span-1 group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-phone-in-talk text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Оставьте заявку</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Свяжитесь с нами по телефону или через форму на сайте.
                            </p>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-clipboard-list text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Определим объем работ</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Специалисты оценят объект и составят план работ.</p>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-file-document text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Подготовим договор</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Согласуем условия и подпишем договор.</p>
                        </div>
                    </div>

                    <div
                        class="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="relative">
                            <div class="flex items-center gap-x-4">
                                <span class="mdi mdi-check-circle text-4xl text-indigo-600"></span>
                                <h3 class="text-xl font-bold text-gray-900">Начинаем работу</h3>
                            </div>
                            <p class="mt-4 text-base text-gray-600">Приступаем к работе по согласованному графику.</p>
                        </div>
                    </div>

                </div>

                <!-- Кнопка -->
                <div class="mt-12 text-center py-12">
                    <a href="{{ route('main.contacts') }}"
                        class="inline-flex items-center gap-x-2 px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-full shadow-lg hover:bg-indigo-500 hover:shadow-xl transition-all">
                        Оставить заявку
                        <span class="mdi mdi-arrow-right text-xl"></span>
                    </a>
                </div>
            </div>
        </div>


        <div class="bg-white">
            <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
                <div
                    class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                    <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Начните работать с нами сегодня
                    </h2>
                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">
                        Мы готовы помочь вам с любыми задачами. Наши специалисты обеспечат качественное выполнение работ в
                        срок.
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
                    <svg viewBox="0 0 1024 1024"
                        class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]"
                        aria-hidden="true">
                        <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)"
                            fill-opacity="0.7" />
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
