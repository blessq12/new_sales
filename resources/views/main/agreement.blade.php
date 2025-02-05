@extends('layouts.main')

@section('title', 'Пользовательское соглашение')
@section('description', 'Пользовательское соглашение')

@section('content')
    <x-hero-banner
        title="Пользовательское соглашение"
        description="Пользовательское соглашение компании ООО 'Салес'"
        :breadcrumbs="[
            ['title' => 'Пользовательское соглашение', 'url' => '/agreement']
        ]"
    />

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <div class="prose prose-lg prose-indigo mx-auto">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">Пользовательское соглашение</h2>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">1. Общие положения</h3>
                    <p class="text-base leading-7 text-gray-600">1.1. Настоящее Пользовательское соглашение (далее — "Соглашение") регулирует отношения между вами (далее — "Пользователь") и [Название компании/сайта] (далее — "Администратор") в отношении использования сайта https://www.sales-tomsk.ru (далее — "Сайт").</p>
                    <p class="text-base leading-7 text-gray-600">1.2. Воспользовавшись Сайтом, Пользователь соглашается с условиями настоящего Соглашения. В случае несогласия с условиями, Пользователь обязан прекратить использование Сайта.</p>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">2. Обязанности сторон</h3>
                    <p class="text-base leading-7 text-gray-600">2.1. Администратор обязуется:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li class="text-base leading-7 text-gray-600">Обеспечить доступность Сайта и его функционала в пределах разумного.</li>
                        <li class="text-base leading-7 text-gray-600">Предоставить Пользователю актуальную информацию о Сайте, если это необходимо.</li>
                        <li class="text-base leading-7 text-gray-600">Защищать личные данные Пользователя в соответствии с Политикой конфиденциальности.</li>
                    </ul>
                    <p class="text-base leading-7 text-gray-600">2.2. Пользователь обязуется:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li class="text-base leading-7 text-gray-600">Соблюдать условия настоящего Соглашения.</li>
                        <li class="text-base leading-7 text-gray-600">Не использовать Сайт для незаконной деятельности, в том числе для распространения вирусов, спама, недостоверной информации и т.д.</li>
                        <li class="text-base leading-7 text-gray-600">Не нарушать права интеллектуальной собственности Администратора и третьих лиц.</li>
                    </ul>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">3. Право на использование контента</h3>
                    <p class="text-base leading-7 text-gray-600">3.1. Все материалы, размещенные на Сайте (включая, но не ограничиваясь текстами, графикой, логотипами, программным обеспечением и т.д.), являются объектами интеллектуальной собственности Администратора или третьих лиц и защищены авторским правом.</p>
                    <p class="text-base leading-7 text-gray-600">3.2. Пользователь может использовать материалы Сайта только в личных, некоммерческих целях и в рамках, предусмотренных действующим законодательством.</p>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">4. Личные данные</h3>
                    <p class="text-base leading-7 text-gray-600">4.1. Администратор собирает и обрабатывает следующие персональные данные Пользователя:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li class="text-base leading-7 text-gray-600">ФИО,</li>
                        <li class="text-base leading-7 text-gray-600">Номер телефона,</li>
                        <li class="text-base leading-7 text-gray-600">Электронная почта.</li>
                    </ul>
                    <p class="text-base leading-7 text-gray-600">4.2. Обработка персональных данных осуществляется в соответствии с Политикой конфиденциальности, размещенной на Сайте.</p>
                    <p class="text-base leading-7 text-gray-600">4.3. Пользователь дает согласие на обработку своих персональных данных, предоставленных при регистрации или в процессе использования Сайта.</p>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">5. Ограничение ответственности</h3>
                    <p class="text-base leading-7 text-gray-600">5.1. Администратор не несет ответственности за:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li class="text-base leading-7 text-gray-600">Проблемы, возникающие из-за действий третьих лиц, включая хакерские атаки и несанкционированный доступ.</li>
                        <li class="text-base leading-7 text-gray-600">Технические неполадки, которые могут повлиять на доступность Сайта.</li>
                        <li class="text-base leading-7 text-gray-600">Прямые или косвенные убытки, понесенные Пользователем в результате использования или невозможности использования Сайта.</li>
                    </ul>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">6. Прекращение действия соглашения</h3>
                    <p class="text-base leading-7 text-gray-600">6.1. Администратор вправе в любое время изменить условия настоящего Соглашения без предварительного уведомления.</p>
                    <p class="text-base leading-7 text-gray-600">6.2. Пользователь может прекратить использование Сайта в любое время, уведомив Администратора.</p>
                    <p class="text-base leading-7 text-gray-600">6.3. В случае нарушения условий Соглашения Администратор вправе приостановить доступ Пользователя к Сайту.</p>

                    <h3 class="text-2xl font-bold tracking-tight text-gray-900">7. Заключительные положения</h3>
                    <p class="text-base leading-7 text-gray-600">7.1. Все споры, возникающие в связи с настоящим Соглашением, будут разрешаться в порядке, установленном законодательством России.</p>
                    <p class="text-base leading-7 text-gray-600">7.2. Если какое-либо положение настоящего Соглашения признано недействительным, это не влияет на действительность остальных положений.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA секция -->
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:flex lg:items-center lg:justify-between lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Остались вопросы?<br>
                Свяжитесь с нами для уточнения деталей.
            </h2>
            <div class="mt-10 flex items-center gap-x-6 lg:mt-0 lg:flex-shrink-0">
                <a href="{{ route('main.contacts') }}"
                   class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Связаться с нами
                </a>
                <a href="{{ route('main.about') }}" class="text-sm font-semibold leading-6 text-gray-900">
                    О компании <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
@endsection
