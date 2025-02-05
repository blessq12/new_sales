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

    <!-- Аналитика -->
    <script type="text/javascript">
        var googleAnalytics = "UA-124901287-1";
        var ipAnonymization = false;

        var googleRemarketing = "";
        var googleTagManager = "GTM-N9HGSXQ";
        var facebookRemarketing = "651294705016616";
        var yandexMetrika = "49782487";
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter49782487 = new Ya.Metrika2({
                        id:49782487,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/49782487" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124901287-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-124901287-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N9HGSXQ');</script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google AdWords: AW-791446128 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-791446128"></script>
    <script>
        !function(w, a) {
            w.dataLayer = w.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            w[a] = (w[a] && w[a].filter(c => c.name !== 'gtag')) || [];
            w[a].push({
                name: 'gtag',
                report: gtag,
                config: {
                    trackingId: 'AW-791446128'
                }
            });
        }(window,"promoteAnalyticsChannels");
    </script>

    <!-- VK Retargeting -->
    <script type="text/javascript">
        !function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?156",t.onload=function(){VK.Retargeting.Init("VK-RTRG-323590-fEypH")},document.head.appendChild(t)}();
    </script>
    <noscript><img src="https://vk.com/rtrg?p=VK-RTRG-323590-fEypH" style="position:fixed; left:-999px;" alt=""/></noscript>
    <script>
        !function(w, a) {
            function vkRetargeting() {
              VK && VK.Retargeting && VK.Retargeting.Hit();
            }

            w[a] = (w[a] && w[a].filter(c => c.name !== 'vkRetargeting')) || [];
            w[a].push({
                name: 'vkRetargeting',
                report: vkRetargeting
            });
        }(window,"promoteAnalyticsChannels");
    </script>

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
