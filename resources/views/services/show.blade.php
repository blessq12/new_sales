@extends('layouts.main')

@section('title', $service->name)
@section('description', $service->description)

@section('content')
    <x-hero-banner
        :image="Storage::disk('uploads')->url($service->image)"
        :title="$service->name"
        :description="$service->description"
        :breadcrumbs="[
            ['title' => 'Услуги', 'url' => route('services')],
            ['title' => $service->name, 'url' => route('services.show', $service->slug)],
        ]"
    ></x-hero-banner>

    <!-- Основной контент -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <!-- Основное описание -->
                <div class="prose prose-lg prose-indigo mx-auto mt-6">
                    {!! $service->content !!}
                </div>

                <!-- Преимущества -->
                <div class="mt-16">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 text-center">Почему выбирают нас</h2>
                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 mx-auto">
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <span class="mdi mdi-check-circle absolute left-1 top-1 text-indigo-600 text-xl"></span>
                                Профессионализм
                            </dt>
                            <dd class="inline">Наши специалисты имеют многолетний опыт и постоянно повышают квалификацию.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <span class="mdi mdi-clock-check absolute left-1 top-1 text-indigo-600 text-xl"></span>
                                Оперативность
                            </dt>
                            <dd class="inline">Выполняем работы точно в срок, учитывая все пожелания заказчика.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <span class="mdi mdi-shield-check absolute left-1 top-1 text-indigo-600 text-xl"></span>
                                Гарантия
                            </dt>
                            <dd class="inline">Предоставляем гарантию на все выполненные работы.</dd>
                        </div>
                    </dl>
                </div>

                <!-- Форма заявки -->
                <div class="mt-16">
                    <div class="relative isolate overflow-hidden bg-gray-900 px-4 py-24 shadow-2xl sm:rounded-3xl sm:px-24 rounded-xl">
                        <h2 class="mx-auto max-w-2xl text-center text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Заказать услугу
                        </h2>
                        <p class="mx-auto mt-2 max-w-xl text-center text-lg leading-8 text-gray-300">
                            Оставьте заявку, и мы свяжемся с вами в ближайшее время
                        </p>
                        <form action="?" method="POST" class="mx-auto mt-10 max-w-md">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <div class="grid grid-cols-1 gap-x-8 gap-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-semibold leading-6 text-white">Ваше имя</label>
                                    <div class="mt-2.5">
                                        <input type="text" 
                                               name="name" 
                                               id="name" 
                                               required
                                               class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-semibold leading-6 text-white">Телефон</label>
                                    <div class="mt-2.5">
                                        <input type="tel" 
                                               name="phone" 
                                               id="phone" 
                                               required
                                               class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-semibold leading-6 text-white">Сообщение</label>
                                    <div class="mt-2.5">
                                        <textarea name="message" 
                                                  id="message" 
                                                  rows="4" 
                                                  class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 flex justify-center">
                                <button type="submit" 
                                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Отправить заявку
                                </button>
                            </div>
                        </form>
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

                <!-- Похожие услуги -->
                {{-- @if($relatedServices)
                    @if($relatedServices->count() > 0)
                        <div class="mt-16">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Похожие услуги</h2>
                            <div class="mt-8 grid grid-cols-1 gap-8 sm:grid-cols-2">
                                @foreach($relatedServices as $relatedService)
                                    <div class="relative isolate flex flex-col gap-8 lg:flex-row">
                                        <div class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0">
                                            <img src="{{ Storage::disk('uploads')->url($relatedService->image) }}" 
                                                alt="{{ $relatedService->name }}" 
                                                class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover">
                                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-x-4 text-xs">
                                                <span class="text-gray-500">{{ $relatedService->category->name }}</span>
                                            </div>
                                            <div class="group relative max-w-xl">
                                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                                    <a href="{{ route('services.show', $relatedService->slug) }}">
                                                        <span class="absolute inset-0"></span>
                                                        {{ $relatedService->name }}
                                                    </a>
                                                </h3>
                                                <p class="mt-5 text-sm leading-6 text-gray-600">{{ $relatedService->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif --}}
            </div>
        </div>
    </div>
@endsection
