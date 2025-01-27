<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description')">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
<body>
    <x-header></x-header>
    <main id="app">
        @yield('content')
    </main>
    <x-footer></x-footer>
</body>
</html>
