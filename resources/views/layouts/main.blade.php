<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="yandex" content="index, follow">
    <meta name="google" content="notranslate">
    <meta name="keywords" content="@yield('keywords')">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js'
        ])
</head>
<body class="font-sans antialiased">
    <div id="app">
        <x-header />

        <main>
            @yield('content')
        </main>

        <x-footer />
        <callback-form ></callback-form>
        <review-form ></review-form>
        <cookie-consent></cookie-consent>
    </div>
</body>
</html>
