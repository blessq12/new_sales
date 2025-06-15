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
    <meta name="description" content="@yield('description')">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('og_image', '/assets/images/banner.png')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title')">
    <meta property="twitter:description" content="@yield('description')">
    <meta property="twitter:image" content="@yield('og_image', '/assets/images/banner.png')">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    @if (config('app.env') === 'production')
        <x-includes.analytics />
    @endif

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<x-json-ld type="Organization" />
<x-json-ld type="WebPage" />

<body class="font-sans antialiased">
    <div id="app">
        <x-header />
        <main>
            @yield('content')
        </main>
        <x-footer />
        <callback-form></callback-form>
        <review-form></review-form>
        <cookie-consent></cookie-consent>
    </div>
</body>

</html>
