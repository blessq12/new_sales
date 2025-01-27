<div class="relative isolate overflow-hidden">
    <!-- Фоновое изображение -->
    <img src="{{ $image }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/80 -z-10"></div>

    <!-- Декоративный элемент -->
    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-24 sm:py-32">
        <!-- Хлебные крошки -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="/" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                        <span class="mdi mdi-home-variant text-xl mr-1"></span>
                        <span>Главная</span>
                    </a>
                </li>
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="flex items-center">
                        <span class="mdi mdi-chevron-right text-gray-500 mx-2"></span>
                        <a href="{{ $breadcrumb['url'] }}" class="text-gray-300 hover:text-white transition-colors duration-200">
                            {{ $breadcrumb['title'] }}
                        </a>
                    </li>
                @endforeach
            </ol>
        </nav>

        <!-- Контент -->
        <div class="max-w-2xl">
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl">
                {{ $title }}
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-300">
                {{ $description }}
            </p>
        </div>
    </div>

    <!-- Нижний декоративный элемент -->
    <div class="absolute inset-x-0 bottom-0 -z-10 transform-gpu overflow-hidden blur-3xl" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-indigo-500 to-purple-500 opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
    </div>
</div>