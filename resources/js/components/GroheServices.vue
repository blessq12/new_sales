<script>
import { gsap } from "gsap";

export default {
    name: "GroheServices",
    data() {
        return {
            services: this.getServices(),
            selectedService: null,
        };
    },
    mounted() {
        this.selectedService = this.services[0];
    },
    methods: {
        selectService(service) {
            if (this.selectedService !== service) {
                gsap.fromTo(
                    this.$refs.selectedService,
                    { opacity: 0, y: 20 },
                    { opacity: 1, y: 0, duration: 0.6, ease: "power3.inOut" }
                );
                this.selectedService = service;
            }
        },
        getServices() {
            return [
                {
                    title: "Смесители",
                    icon: "🚿",
                    description:
                        "Установка, ремонт и обслуживание смесителей GROHE для ванной и кухни.",
                    items: [
                        {
                            title: "Кухонные смесители",
                            icon: "🚰",
                            details:
                                "Монтаж и ремонт кухонных смесителей GROHE, включая модели с выдвижным изливом.",
                        },
                        {
                            title: "Смесители для ванной",
                            icon: "🛁",
                            details:
                                "Установка и обслуживание однорычажных и термостатических смесителей.",
                        },
                        {
                            title: "Сенсорные смесители",
                            icon: "👆",
                            details:
                                "Настройка и ремонт бесконтактных смесителей с технологией GROHE.",
                        },
                    ],
                },
                {
                    title: "Душевые системы",
                    icon: "🚿",
                    description:
                        "Установка и ремонт душевых систем GROHE для идеального душа.",
                    items: [
                        {
                            title: "Душевые гарнитуры",
                            icon: "🚿",
                            details:
                                "Монтаж и обслуживание ручных и верхних душей GROHE.",
                        },
                        {
                            title: "Термостаты для душа",
                            icon: "🌡️",
                            details:
                                "Ремонт и настройка душевых термостатов для стабильной температуры.",
                        },
                        {
                            title: "Системы SmartControl",
                            icon: "⚙️",
                            details:
                                "Установка и диагностика систем GROHE SmartControl.",
                        },
                    ],
                },
                {
                    title: "Санузлы и инсталляции",
                    icon: "🚽",
                    description:
                        "Полный цикл работ с унитазами и инсталляциями GROHE.",
                    items: [
                        {
                            title: "Установка инсталляций",
                            icon: "🚽",
                            details:
                                "Профессиональный монтаж систем инсталляции GROHE Rapid SL и других.",
                        },
                        {
                            title: "Ремонт унитазов",
                            icon: "🔧",
                            details:
                                "Диагностика и ремонт подвесных и напольных унитазов GROHE.",
                        },
                        {
                            title: "Настройка механизмов",
                            icon: "⚙️",
                            details:
                                "Регулировка смывных клапанов и кнопок управления.",
                        },
                    ],
                },
                {
                    title: "Аксессуары",
                    icon: "🧼",
                    description:
                        "Установка и замена аксессуаров GROHE для ванной и кухни.",
                    items: [
                        {
                            title: "Держатели и полки",
                            icon: "🧼",
                            details:
                                "Монтаж аксессуаров GROHE для ванной: держатели, полки, мыльницы.",
                        },
                        {
                            title: "Кухонные аксессуары",
                            icon: "🍽️",
                            details:
                                "Установка дозаторов для мыла и других кухонных аксессуаров.",
                        },
                        {
                            title: "Ремонт и замена",
                            icon: "🔧",
                            details:
                                "Замена изношенных аксессуаров с сохранением стиля GROHE.",
                        },
                    ],
                },
                {
                    title: "Запчасти",
                    icon: "🔧",
                    description:
                        "Поставка и установка оригинальных запчастей GROHE.",
                    items: [
                        {
                            title: "Оригинальные комплектующие",
                            icon: "🔩",
                            details:
                                "Поставка сертифицированных запчастей для всех продуктов GROHE.",
                        },
                        {
                            title: "Заказ из Германии",
                            icon: "✈️",
                            details:
                                "Доставка редких деталей напрямую от производителя.",
                        },
                        {
                            title: "Гарантия подлинности",
                            icon: "✅",
                            details:
                                "Все запчасти с официальной гарантией GROHE.",
                        },
                    ],
                },
            ];
        },
    },
};
</script>

<template>
    <div class="py-20 md:py-40" id="services">
        <div class="max-w-7xl mx-auto px-4">
            <h2
                class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 text-center"
            >
                Услуги по продукции GROHE
            </h2>
            <p
                class="text-xl text-gray-600 mb-12 text-center max-w-3xl mx-auto"
            >
                Как авторизованный сервисный центр GROHE, мы выполняем
                профессиональную установку, обслуживание и ремонт всей
                сантехники GROHE с использованием оригинальных запчастей.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Список сервисов -->
                <div>
                    <ul class="flex flex-col gap-3">
                        <li v-for="service in services" :key="service.title">
                            <button
                                @click="selectService(service)"
                                class="flex items-center w-full border-gray-200 rounded-xl py-3 px-4 shadow-sm hover:shadow-md transition-shadow duration-300"
                                :class="{
                                    'bg-indigo-600 border-indigo-500 text-gray-100':
                                        selectedService === service,
                                }"
                            >
                                <span class="mr-3 text-2xl">{{
                                    service.icon
                                }}</span>

                                <span
                                    class="text-lg font-semibold"
                                    :class="{
                                        'text-gray-100':
                                            selectedService === service,
                                    }"
                                    >{{ service.title }}</span
                                >
                            </button>
                        </li>
                    </ul>
                </div>
                <div>
                    <div
                        class="bg-indigo-600 border text-gray-100 border-gray-50 rounded-xl p-6 shadow-sm"
                        ref="selectedService"
                    >
                        <div v-if="selectedService">
                            <h4
                                class="text-2xl md:text-3xl font-bold text-gray-100 mb-4"
                            >
                                {{ selectedService.title }}
                            </h4>
                            <p class="text-gray-100 mb-6">
                                {{ selectedService.description }}
                            </p>
                            <ul class="grid grid-cols-1 gap-4">
                                <li
                                    v-for="item in selectedService.items"
                                    :key="item.title"
                                    class="py-2"
                                >
                                    <div class="flex items-center mb-1">
                                        <span class="mr-2 text-xl">{{
                                            item.icon
                                        }}</span>
                                        <h5
                                            class="text-lg font-semibold text-gray-100"
                                        >
                                            {{ item.title }}
                                        </h5>
                                    </div>
                                    <p class="text-gray-100 text-sm">
                                        {{ item.details }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-gray-50 {
    background-color: #f9fafb;
}

button {
    transition: all 0.3s ease;
}

button:hover {
    @apply bg-blue-100 border-blue-400 shadow-md;
}

button:focus {
    @apply outline-none ring-2 ring-blue-300;
}

.shadow-lg {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.border-blue-500 {
    border-color: #3b82f6;
}

.bg-blue-50 {
    background-color: #eff6ff;
}

.text-gray-800 {
    color: #1f2937;
}

.bg-blue-500 {
    background-color: #3b82f6;
}

.bg-blue-600 {
    background-color: #2563eb;
}
</style>
