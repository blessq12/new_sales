<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div id="app">
        <x-header />

        <main>
            @yield('content')
        </main>

        <x-footer />

        <!-- Модальные окна -->
        <callback-form v-model="showCallbackForm" @success="showSuccessMessage"></callback-form>
        <review-form v-model="showReviewForm" @success="showSuccessMessage"></review-form>

        <!-- Уведомление о cookies -->
        <cookie-consent></cookie-consent>

        <!-- Уведомление об успешной отправке формы -->
        <div v-if="successMessage" 
             class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center"
             @click="successMessage = ''"
        >
            <span class="mdi mdi-check-circle mr-2"></span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const app = Vue.createApp({
                data() {
                    return {
                        showCallbackForm: false,
                        showReviewForm: false,
                        successMessage: ''
                    }
                },
                methods: {
                    showSuccessMessage(message) {
                        this.successMessage = message
                        setTimeout(() => {
                            this.successMessage = ''
                        }, 5000)
                    }
                }
            })

            // Глобально регистрируем компоненты
            app.component('callback-form', CallbackForm)
            app.component('review-form', ReviewForm)
            app.component('cookie-consent', CookieConsent)
            app.component('base-modal', BaseModal)

            app.mount('#app')

            // Добавляем обработчики для кнопок открытия модальных окон
            window.openCallbackForm = function() {
                app.config.globalProperties.showCallbackForm = true
            }

            window.openReviewForm = function() {
                app.config.globalProperties.showReviewForm = true
            }
        })
    </script>
</body>
</html>
