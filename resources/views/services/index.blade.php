@extends('layouts.main')
@section('title', 'Услуги')
@section('description', 'Узнайте о наших услугах, которые помогут вам решить задачи и достичь результатов. Выберите
    подходящее решение для вас.')

@section('content')
    <x-hero-banner title="Услуги"
        description="Узнайте о наших услугах, которые помогут решить ваши задачи и достичь результатов. Выберите подходящее решение для вас."
        :breadcrumbs="[['title' => 'Услуги', 'url' => route('services')]]"></x-hero-banner>

    <!-- Поиск -->
    <search-component type="desktop"></search-component>

    <!-- Список услуг -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            @foreach ($services as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>
    </div>

    <!-- FAQ секция -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">FAQ</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Часто задаваемые вопросы
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Ответы на самые популярные вопросы о наших услугах
                </p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl" itemscope itemtype="https://schema.org/FAQPage">
                <!-- Вопрос 1 -->
                <div class="mb-8" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 class="text-lg font-semibold text-gray-900" itemprop="name">
                        Какие виды сантехнических работ вы выполняете?
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="mt-4 text-gray-600" itemprop="text">
                            Мы выполняем полный спектр сантехнических работ: установка и ремонт сантехники, монтаж систем
                            отопления, водоснабжения и канализации, устранение протечек, прочистка засоров, замена труб и
                            многое другое. Работаем как с частными домами, так и с квартирами и коммерческими помещениями.
                        </div>
                    </div>
                </div>

                <!-- Вопрос 2 -->
                <div class="mb-8" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 class="text-lg font-semibold text-gray-900" itemprop="name">
                        Какие гарантии вы предоставляете на выполненные работы?
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="mt-4 text-gray-600" itemprop="text">
                            Мы предоставляем гарантию 2 года на все выполненные работы. В случае возникновения проблем в
                            гарантийный период, мы бесплатно устраним неисправности. Кроме того, мы работаем только с
                            проверенными материалами и оборудованием, что обеспечивает долговечность результата.
                        </div>
                    </div>
                </div>

                <!-- Вопрос 3 -->
                <div class="mb-8" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 class="text-lg font-semibold text-gray-900" itemprop="name">
                        Как быстро вы можете приехать на вызов?
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="mt-4 text-gray-600" itemprop="text">
                            В экстренных случаях (протечки, засоры) мы приезжаем в течение 1 часа. Для плановых работ время
                            выезда согласовывается индивидуально, обычно в течение текущего или следующего дня. Мы работаем
                            без выходных с 8:00 до 22:00.
                        </div>
                    </div>
                </div>

                <!-- Вопрос 4 -->
                <div class="mb-8" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <h3 class="text-lg font-semibold text-gray-900" itemprop="name">
                        Работаете ли вы в области?
                    </h3>
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="mt-4 text-gray-600" itemprop="text">
                            Да, мы работаем в Томске, Северске и области в радиусе до 300 км. Выезд за пределы города
                            оговаривается отдельно. Стоимость выезда зависит от удаленности объекта.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA секция -->
    <div class="relative isolate overflow-hidden bg-gray-900 py-16 sm:py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                <div class="max-w-xl lg:max-w-lg">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Не нашли нужную услугу?</h2>
                    <p class="mt-4 text-lg leading-8 text-gray-300">
                        Оставьте заявку на нашем сайте, и мы свяжемся с вами в течение 15 минут. Мы готовы помочь вам найти
                        решение, которое соответствует вашим потребностям.
                    </p>
                    <div class="mt-6 flex max-w-md gap-x-4">
                        <button @click="openModal('callback')"
                            class="flex-none rounded-xl bg-indigo-500 px-8 py-4 text-base font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition-all duration-200">
                            Оставить заявку
                        </button>
                    </div>
                </div>
                <dl class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:pt-2">
                    <div class="flex flex-col items-start">
                        <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                            <span class="mdi mdi-clock-fast text-2xl text-white"></span>
                        </div>
                        <dt class="mt-4 font-semibold text-white">Быстрый ответ</dt>
                        <dd class="mt-2 leading-7 text-gray-400">Мы свяжемся с вами в течение 15 минут после получения
                            заявки</dd>
                    </div>
                    <div class="flex flex-col items-start">
                        <div class="rounded-md bg-white/5 p-2 ring-1 ring-white/10">
                            <span class="mdi mdi-account-check text-2xl text-white"></span>
                        </div>
                        <dt class="mt-4 font-semibold text-white">Профессиональная консультация</dt>
                        <dd class="mt-2 leading-7 text-gray-400">Наши специалисты помогут подобрать оптимальное решение</dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-30"></div>
        </div>
    </div>
@endsection
