@extends('layouts.main')

@section('title', 'Политика конфиденциальности')
@section('description', 'Политика конфиденциальности')

@section('content')
    <x-hero-banner 
        :image="asset('images/hero-banner.jpg')"
        title="Политика в отношении обработки персональных данных" 
        description="Настоящая политика обработки персональных данных составлена в соответствии с требованиями Федерального закона от 27.07.2006. № 152-ФЗ «О персональных данных»." 
        image="https://via.placeholder.com/1920x1080"
        :breadcrumbs="[
            ['title' => 'Политика конфиденциальности', 'url' => route('main.privacy')]
        ]"
    />

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Основные разделы -->
            {{-- <div class="mx-auto max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <span class="mdi mdi-shield-check text-white text-xl"></span>
                            </div>
                            Безопасность данных
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Мы принимаем все необходимые меры для защиты персональных данных наших пользователей от несанкционированного доступа.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <span class="mdi mdi-lock text-white text-xl"></span>
                            </div>
                            Конфиденциальность
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Мы гарантируем конфиденциальность предоставленной информации и используем её только в соответствии с политикой.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            <div class="mb-6 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <span class="mdi mdi-account-check text-white text-xl"></span>
                            </div>
                            Права пользователей
                        </dt>
                        <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Пользователи имеют право на доступ, исправление и удаление своих персональных данных.</p>
                        </dd>
                    </div>
                </dl>
            </div> --}}

            <!-- Подробное описание -->
            <div class="mx-auto max-w-4xl">
                <div class="prose prose-lg prose-indigo mx-auto">
                    <div class="space-y-12">
                        <!-- 1. Общие положения -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">1. Общие положения</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">
                                    1.1. Оператор ставит своей важнейшей целью и условием осуществления своей деятельности соблюдение прав и свобод человека и гражданина при обработке его персональных данных, в том числе защиты прав на неприкосновенность частной жизни, личную и семейную тайну.
                                </p>
                                <p class="text-base leading-7 text-gray-600">
                                    1.2. Настоящая политика Оператора в отношении обработки персональных данных применяется ко всей информации, которую Оператор может получить о посетителях веб-сайта https://www.sales-tomsk.ru.
                                </p>
                            </div>
                        </div>

                        <!-- 2. Основные понятия -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">2. Основные понятия, используемые в Политике</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">2.1. Автоматизированная обработка персональных данных — обработка персональных данных с помощью средств вычислительной техники.</p>
                                <p class="text-base leading-7 text-gray-600">2.2. Блокирование персональных данных — временное прекращение обработки персональных данных (за исключением случаев, когда обработка необходима для уточнения персональных данных).</p>
                                <p class="text-base leading-7 text-gray-600">2.3. Веб-сайт — совокупность графических и информационных материалов, а также программ для ЭВМ и баз данных, обеспечивающих их доступность в сети интернет по сетевому адресу https://www.sales-tomsk.ru.</p>
                                <p class="text-base leading-7 text-gray-600">2.4. Информационная система персональных данных — совокупность содержащихся в базах данных персональных данных и обеспечивающих их обработку информационных технологий и технических средств.</p>
                                <p class="text-base leading-7 text-gray-600">2.5. Обезличивание персональных данных — действия, в результате которых невозможно определить без использования дополнительной информации принадлежность персональных данных конкретному Пользователю или иному субъекту персональных данных.</p>
                                <p class="text-base leading-7 text-gray-600">2.6. Обработка персональных данных — любое действие (операция) или совокупность действий (операций), совершаемых с использованием средств автоматизации или без использования таких средств с персональными данными, включая сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, передачу (распространение, предоставление, доступ), обезличивание, блокирование, удаление, уничтожение персональных данных.</p>
                                <p class="text-base leading-7 text-gray-600">2.7. Оператор — государственный орган, муниципальный орган, юридическое или физическое лицо, самостоятально или совместно с другими лицами организующие и/или осуществляющие обработку персональных данных, а также определяющие цели обработки персональных данных, состав персональных данных, подлежащих обработке, действия (операции), совершаемые с персональными данными.</p>
                                <p class="text-base leading-7 text-gray-600">2.8. Персональные данные — любая информация, относящаяся прямо или косвенно к определенному или определяемому Пользователю веб-сайта https://www.sales-tomsk.ru.</p>
                                <p class="text-base leading-7 text-gray-600">2.9. Персональные данные, разрешенные субъектом персональных данных для распространения, — персональные данные, доступ неограниченного круга лиц к которым предоставлен субъектом персональных данных путем дачи согласия на обработку персональных данных, разрешенных субъектом персональных данных для распространения в порядке, предусмотренном Законом о персональных данных.</p>
                                <p class="text-base leading-7 text-gray-600">2.10. Пользователь — любой посетитель веб-сайта https://www.sales-tomsk.ru.</p>
                            </div>
                        </div>

                        <!-- 3. Основные права и обязанности Оператора -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">3. Основные права и обязанности Оператора</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">3.1. Оператор имеет право:</p>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li class="text-base leading-7 text-gray-600">получать от субъекта персональных данных достоверные информацию и/или документы, содержащие персональные данные;</li>
                                    <li class="text-base leading-7 text-gray-600">в случае отзыва субъектом персональных данных согласия на обработку персональных данных Оператор вправе продолжить обработку персональных данных без согласия субъекта персональных данных при наличии оснований, указанных в Законе о персональных данных;</li>
                                </ul>
                                <p class="text-base leading-7 text-gray-600">3.2. Оператор обязан:</p>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li class="text-base leading-7 text-gray-600">предоставлять субъекту персональных данных по его просьбе информацию, касающуюся обработки его персональных данных;</li>
                                    <li class="text-base leading-7 text-gray-600">организовывать обработку персональных данных в порядке, установленном действующим законодательством РФ;</li>
                                    <li class="text-base leading-7 text-gray-600">отвечать на обращения и запросы субъектов персональных данных и их законных представителей в соответствии с требованиями Закона о персональных данных;</li>
                                </ul>
                            </div>
                        </div>

                        <!-- 4. Цели обработки персональных данных -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">4. Цели обработки персональных данных</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">4.1. Цель обработки: информирование Пользователя посредством отправки электронных писем</p>
                                <p class="text-base leading-7 text-gray-600">4.2. Персональные данные:</p>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li class="text-base leading-7 text-gray-600">фамилия, имя, отчество</li>
                                    <li class="text-base leading-7 text-gray-600">электронный адрес</li>
                                    <li class="text-base leading-7 text-gray-600">номера телефонов</li>
                                    <li class="text-base leading-7 text-gray-600">год, месяц, дата и место рождения</li>
                                    <li class="text-base leading-7 text-gray-600">фотографии</li>
                                </ul>
                            </div>
                        </div>

                        <!-- 5. Порядок и условия обработки персональных данных -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">5. Порядок и условия обработки персональных данных</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">5.1. Оператор обеспечивает сохранность персональных данных и принимает все возможные меры, исключающие доступ к персональным данным неуполномоченных лиц.</p>
                                <p class="text-base leading-7 text-gray-600">5.2. Персональные данные Пользователя никогда, ни при каких условиях не будут переданы третьим лицам, за исключением случаев, связанных с исполнением действующего законодательства.</p>
                                <p class="text-base leading-7 text-gray-600">5.3. В случае выявления неточностей в персональных данных, Пользователь может актуализировать их, направив Оператору уведомление на адрес электронной почты Оператора sales-tom@yandex.ru с пометкой «Актуализация персональных данных».</p>
                            </div>
                        </div>

                        <!-- 6. Заключительные положения -->
                        <div>
                            <h3 class="text-2xl font-bold tracking-tight text-gray-900">6. Заключительные положения</h3>
                            <div class="mt-6 space-y-4">
                                <p class="text-base leading-7 text-gray-600">6.1. Пользователь может получить любые разъяснения по интересующим вопросам, касающимся обработки его персональных данных, обратившись к Оператору с помощью электронной почты sales-tom@yandex.ru.</p>
                                <p class="text-base leading-7 text-gray-600">6.2. В данном документе будут отражены любые изменения политики обработки персональных данных Оператором. Политика действует бессрочно до замены ее новой версией.</p>
                                <p class="text-base leading-7 text-gray-600">6.3. Актуальная версия Политики в свободном доступе расположена в сети Интернет по адресу https://www.sales-tomsk.ru/privacy.</p>
                            </div>
                        </div>
                    </div>
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
