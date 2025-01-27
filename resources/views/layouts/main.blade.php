<!DOCTYPE html>
<html lang="ru" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description')">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
<body class="h-full bg-gray-50 text-gray-900 antialiased">
    <div class="min-h-full flex flex-col">
        <x-header></x-header>
        <main id="app" class="flex-grow">
            @yield('content')
        </main>
        <x-footer></x-footer>
    </div>
</body>
</html>
