<script>
export default {
    name: 'CookieConsent',
    data() {
        return {
            isVisible: false
        }
    },
    mounted() {
        // Проверяем, было ли уже получено согласие
        if (!localStorage.getItem('cookieConsent')) {
            this.isVisible = true
        }
    },
    methods: {
        accept() {
            localStorage.setItem('cookieConsent', 'true')
            this.isVisible = false
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>

<template>
    <transition name="fade">
        <div v-if="isVisible" class="fixed bottom-0 left-0 right-0 bg-white shadow-lg z-50 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex-1">
                        <p class="text-gray-600">
                            Мы используем файлы cookie для улучшения работы сайта. Продолжая использовать наш сайт, вы соглашаетесь с нашей 
                            <a href="/privacy" class="text-indigo-600 hover:text-indigo-500">политикой конфиденциальности</a>.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <button @click="accept" class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            Принять
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>


