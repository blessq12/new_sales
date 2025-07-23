<template>
    <div>
        <!-- Кнопка открытия чата -->
        <button
            v-if="!isOpen"
            @click="openChat"
            class="fixed bottom-4 right-4 z-50 bg-indigo-600 text-white rounded-full p-4 shadow-lg hover:bg-indigo-700 transition-all duration-200"
        >
            <span class="mdi mdi-message-text text-2xl"></span>
        </button>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-full md:translate-y-0 md:scale-95"
            enter-to-class="opacity-100 translate-y-0 md:scale-100"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 translate-y-0 md:scale-100"
            leave-to-class="opacity-0 translate-y-full md:translate-y-0 md:scale-95"
        >
            <div
                v-if="isOpen"
                class="fixed inset-0 z-50 md:inset-auto md:bottom-4 md:right-4"
            >
                <div
                    class="fixed inset-0 bg-black bg-opacity-50 md:hidden"
                    @click="isOpen = false"
                ></div>

                <!-- Контейнер чата -->
                <div
                    class="relative flex flex-col w-full h-full md:w-96 md:h-[600px] md:max-h-[80vh] bg-white md:rounded-xl shadow-2xl"
                >
                    <!-- Шапка -->
                    <div
                        class="flex items-center justify-between p-4 bg-indigo-600 text-white md:rounded-t-xl"
                    >
                        <div class="flex items-center">
                            <span class="mdi mdi-robot text-2xl mr-2"></span>
                            <h3 class="font-semibold text-lg">
                                Онлайн-консультант
                            </h3>
                        </div>
                        <button
                            @click="isOpen = false"
                            class="p-2 hover:bg-indigo-700 rounded-full transition-colors"
                        >
                            <span class="mdi mdi-close text-xl"></span>
                        </button>
                    </div>

                    <!-- Сообщения -->
                    <div
                        class="flex-1 overflow-y-auto p-4 space-y-4"
                        ref="messages"
                    >
                        <TransitionGroup
                            name="message"
                            tag="div"
                            class="space-y-4"
                        >
                            <div
                                v-for="message in messages"
                                :key="message.id"
                                class="space-y-2"
                            >
                                <div
                                    v-if="message.type === 'bot'"
                                    class="bg-gray-100 rounded-lg p-3 max-w-[80%] bot-message"
                                >
                                    {{ message.text }}
                                </div>

                                <div v-if="message.options" class="space-y-2">
                                    <TransitionGroup
                                        name="option"
                                        tag="div"
                                        class="space-y-2"
                                    >
                                        <template
                                            v-if="
                                                [
                                                    'category_select',
                                                    'service_select',
                                                    'button_select',
                                                ].includes(message.step_type)
                                            "
                                        >
                                            <button
                                                v-for="(
                                                    option, idx
                                                ) in message.options"
                                                :key="option.id || option"
                                                @click="
                                                    selectOption(
                                                        option,
                                                        message.step_id
                                                    )
                                                "
                                                class="block w-full text-left px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors"
                                                :style="{
                                                    animationDelay: `${
                                                        idx * 100
                                                    }ms`,
                                                }"
                                            >
                                                <template
                                                    v-if="
                                                        message.step_type ===
                                                        'service_select'
                                                    "
                                                >
                                                    {{ option.name }}
                                                    <span
                                                        class="text-sm text-gray-500 block"
                                                        >от
                                                        {{ option.price }}
                                                        ₽</span
                                                    >
                                                </template>
                                                <template v-else>
                                                    {{ option.name || option }}
                                                </template>
                                            </button>
                                        </template>
                                    </TransitionGroup>
                                </div>

                                <!-- Форма контактов -->
                                <div
                                    v-if="message.step_type === 'contact_form'"
                                    class="space-y-4 bg-white rounded-lg p-4 shadow-sm border border-gray-100"
                                >
                                    <div class="text-sm text-gray-500 mb-2">
                                        Пожалуйста, заполните форму ниже:
                                    </div>
                                    <div
                                        v-for="(label, field) in message.fields"
                                        :key="field"
                                        class="space-y-1"
                                    >
                                        <label
                                            :for="field"
                                            class="block text-sm font-medium text-gray-700"
                                            >{{ label }}</label
                                        >
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                            >
                                                <span
                                                    class="text-gray-500 sm:text-sm"
                                                >
                                                    <i
                                                        :class="
                                                            field === 'phone'
                                                                ? 'mdi mdi-phone'
                                                                : 'mdi mdi-account'
                                                        "
                                                        class="text-lg"
                                                    ></i>
                                                </span>
                                            </div>
                                            <input
                                                :type="
                                                    field === 'phone'
                                                        ? 'tel'
                                                        : 'text'
                                                "
                                                :id="field"
                                                v-model="formData[field]"
                                                :placeholder="
                                                    field === 'phone'
                                                        ? '+7 (999) 999-99-99'
                                                        : 'Иван'
                                                "
                                                class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-200"
                                                :class="{
                                                    'border-red-300 focus:ring-red-500 focus:border-red-500':
                                                        formErrors[field],
                                                }"
                                                required
                                                @keydown.enter.prevent="
                                                    submitForm
                                                "
                                                @input="clearError(field)"
                                                v-maska
                                                :data-maska="
                                                    field === 'phone'
                                                        ? '+7 (###) ###-##-##'
                                                        : null
                                                "
                                            />
                                            <div
                                                v-if="formErrors[field]"
                                                class="text-red-500 text-xs mt-1"
                                            >
                                                {{ formErrors[field] }}
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        @click.prevent="submitForm"
                                        :disabled="
                                            !formData.name || !formData.phone
                                        "
                                        class="w-full bg-indigo-600 text-white rounded-lg px-4 py-3 hover:bg-indigo-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2"
                                    >
                                        <span class="mdi mdi-send"></span>
                                        <span>Отправить</span>
                                    </button>
                                </div>

                                <!-- Сообщение об ошибке -->
                                <div
                                    v-if="message.type === 'error'"
                                    class="bg-red-50 border border-red-200 rounded-lg p-4 space-y-3"
                                >
                                    <div class="flex items-center text-red-800">
                                        <span
                                            class="mdi mdi-alert-circle mr-2 text-xl"
                                        ></span>
                                        {{ message.text }}
                                    </div>
                                    <!-- <div class="flex items-center space-x-2">
                                        <button
                                            @click="restartChat"
                                            class="flex items-center space-x-1 px-3 py-2 bg-white text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-sm"
                                        >
                                            <span class="mdi mdi-refresh"></span>
                                            <span>Начать заново</span>
                                        </button>
                                        <button
                                            @click="clearChat"
                                            class="flex items-center space-x-1 px-3 py-2 bg-white text-gray-700 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors text-sm"
                                        >
                                            <span class="mdi mdi-delete"></span>
                                            <span>Очистить историю</span>
                                        </button>
                                    </div> -->
                                </div>

                                <div
                                    v-if="message.type === 'user'"
                                    class="bg-indigo-600 text-white rounded-lg p-3 max-w-[80%] ml-auto user-message"
                                >
                                    {{ message.text }}
                                </div>
                            </div>
                        </TransitionGroup>
                    </div>

                    <!-- Индикатор прокрутки -->
                    <div
                        v-if="showScrollIndicator"
                        class="absolute bottom-20 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-3 py-1 rounded-full text-sm animate-bounce cursor-pointer"
                        @click="scrollToBottom"
                    >
                        <span class="mdi mdi-chevron-down mr-1"></span>
                        Новые сообщения
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script>
import axios from "axios";
import { gsap } from "gsap";

export default {
    name: "Chatbot",

    data() {
        return {
            isOpen: false,
            sessionId: null,
            messages: [],
            currentStep: null,
            formData: {
                name: "",
                phone: "",
            },
            formErrors: {
                name: "",
                phone: "",
            },
            // Добавляем состояние для хранения выбранных опций
            selectedOptions: {
                category_id: null,
                service_id: null,
                timing: null,
            },
            showScrollIndicator: false,
            isScrolledToBottom: true,
            autoOpenTimer: null,
            hasBeenOpened: false, // Флаг для отслеживания, был ли уже открыт чат
        };
    },

    mounted() {
        // Добавляем обработчик прокрутки
        this.$nextTick(() => {
            const messagesContainer = this.$refs.messages;
            if (messagesContainer) {
                messagesContainer.addEventListener("scroll", this.handleScroll);
            }

            // Запускаем таймер только если чат еще не открывался
            if (!this.hasBeenOpened && !this.getChatOpenedCookie()) {
                this.startAutoOpenTimer();
            }
        });
    },

    beforeDestroy() {
        // Удаляем обработчик при уничтожении компонента
        const messagesContainer = this.$refs.messages;
        if (messagesContainer) {
            messagesContainer.removeEventListener("scroll", this.handleScroll);
        }
        // Очищаем таймер при уничтожении компонента
        if (this.autoOpenTimer) {
            clearTimeout(this.autoOpenTimer);
        }
    },

    methods: {
        startAutoOpenTimer() {
            this.autoOpenTimer = setTimeout(() => {
                if (!this.isOpen && !this.hasBeenOpened) {
                    this.openChat();
                    this.hasBeenOpened = true;
                    this.setChatOpenedCookie();
                }
            }, 30000); // 30 секунд
        },

        // Сохраняем в куки информацию о том, что чат уже открывался
        setChatOpenedCookie() {
            const date = new Date();
            date.setTime(date.getTime() + 24 * 60 * 60 * 1000); // Куки на 24 часа
            document.cookie =
                "chatbot_opened=true; expires=" +
                date.toUTCString() +
                "; path=/";
        },

        // Проверяем, открывался ли уже чат
        getChatOpenedCookie() {
            const cookies = document.cookie.split(";");
            for (let cookie of cookies) {
                const [name, value] = cookie.trim().split("=");
                if (name === "chatbot_opened") {
                    return value === "true";
                }
            }
            return false;
        },

        async openChat() {
            this.isOpen = true;
            this.hasBeenOpened = true;
            // Очищаем таймер при ручном открытии
            if (this.autoOpenTimer) {
                clearTimeout(this.autoOpenTimer);
            }
            if (!this.sessionId) {
                const { data } = await axios.get("/api/chatbot/start");
                this.sessionId = data.session_id;
                this.addMessage("bot", data.step.message, data.step);
            }
        },

        addMessage(type, text, step = null) {
            const message = {
                id: Date.now(),
                type,
                text,
                options: step?.data || null,
                step_type: step?.type || null,
                step_id: step?.id || null,
                fields: step?.fields || null,
            };

            // Если это сообщение об ошибке, удаляем предыдущие сообщения об ошибках
            if (type === "error") {
                this.messages = this.messages.filter((m) => m.type !== "error");
            }

            this.messages.push(message);
            this.$nextTick(() => {
                if (this.isScrolledToBottom) {
                    this.scrollToBottom();
                } else {
                    this.showScrollIndicator = true;
                }
                if (step?.data) {
                    this.animateOptions();
                }
            });
        },

        animateOptions() {
            gsap.from(".option-enter-active", {
                opacity: 0,
                y: 20,
                duration: 0.5,
                stagger: 0.1,
                ease: "power2.out",
            });
        },

        scrollToBottom() {
            const container = this.$refs.messages;
            if (container) {
                gsap.to(container, {
                    duration: 0.3,
                    scrollTop: container.scrollHeight,
                    ease: "power2.out",
                    onComplete: () => {
                        this.showScrollIndicator = false;
                        this.isScrolledToBottom = true;
                    },
                });
            }
        },

        handleScroll() {
            const container = this.$refs.messages;
            if (!container) return;

            const isAtBottom =
                container.scrollHeight - container.scrollTop <=
                container.clientHeight + 100;
            this.isScrolledToBottom = isAtBottom;
            this.showScrollIndicator = !isAtBottom && this.messages.length > 0;
        },

        async selectOption(option, stepId) {
            const answer = option.id || option;
            const displayText = option.name || option;

            // Сохраняем выбранное значение в зависимости от шага
            switch (stepId) {
                case "service_selection":
                    this.selectedOptions.category_id = answer;
                    break;
                case "service_details":
                    this.selectedOptions.service_id = answer;
                    break;
                case "timing":
                    this.selectedOptions.timing = answer;
                    break;
            }

            this.addMessage("user", displayText);

            try {
                const { data } = await axios.post("/api/chatbot/answer", {
                    session_id: this.sessionId,
                    step_id: stepId,
                    answer: answer,
                });

                this.currentStep = data.step;
                this.addMessage("bot", data.step.message, data.step);
            } catch (error) {
                console.error("Error:", error);
                this.addMessage(
                    "error",
                    "Извините, произошла ошибка. Попробуйте еще раз."
                );
            }
        },

        clearError(field) {
            this.formErrors[field] = "";
        },

        validateForm() {
            let isValid = true;
            this.formErrors = {
                name: "",
                phone: "",
            };

            if (!this.formData.name.trim()) {
                this.formErrors.name = "Пожалуйста, введите ваше имя";
                isValid = false;
            }

            const phoneRegex = /^\+?[78][-\(]?\d{3}\)?-?\d{3}-?\d{2}-?\d{2}$/;
            if (!phoneRegex.test(this.formData.phone.replace(/\s+/g, ""))) {
                this.formErrors.phone = "Введите корректный номер телефона";
                isValid = false;
            }

            return isValid;
        },

        async submitForm() {
            if (!this.validateForm()) return;

            this.addMessage(
                "user",
                `${this.formData.name}, ${this.formData.phone}`
            );

            try {
                const { data } = await axios.post("/api/chatbot/answer", {
                    session_id: this.sessionId,
                    step_id: this.currentStep.id,
                    answer: {
                        ...this.formData,
                        ...this.selectedOptions, // Добавляем все выбранные опции
                    },
                });

                this.addMessage("bot", data.step.message);
                this.formData = { name: "", phone: "" };
                this.selectedOptions = {
                    category_id: null,
                    service_id: null,
                    timing: null,
                };
            } catch (error) {
                console.error("Error:", error);
                this.addMessage(
                    "error",
                    "Извините, произошла ошибка при отправке формы. Попробуйте еще раз."
                );
            }
        },

        restartChat() {
            this.sessionId = null;
            this.messages = [];
            this.formData = { name: "", phone: "" };
            this.formErrors = { name: "", phone: "" };
            this.selectedOptions = {
                category_id: null,
                service_id: null,
                timing: null,
            };
            this.openChat();
        },

        clearChat() {
            this.messages = [];
            this.sessionId = null;
            this.formData = { name: "", phone: "" };
            this.formErrors = { name: "", phone: "" };
            this.selectedOptions = {
                category_id: null,
                service_id: null,
                timing: null,
            };
            this.isOpen = false;
        },
    },
};
</script>

<style>
.message-enter-active,
.message-leave-active {
    transition: all 0.3s ease;
}

.message-enter-from,
.message-leave-to {
    opacity: 0;
    transform: translateY(20px);
}

.option-enter-active {
    transition: all 0.3s ease;
    transition-delay: var(--delay, 0ms);
}

.option-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.bot-message {
    animation: slideInLeft 0.3s ease-out;
}

.user-message {
    animation: slideInRight 0.3s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.error-message {
    animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
}

@keyframes shake {
    10%,
    90% {
        transform: translate3d(-1px, 0, 0);
    }
    20%,
    80% {
        transform: translate3d(2px, 0, 0);
    }
    30%,
    50%,
    70% {
        transform: translate3d(-4px, 0, 0);
    }
    40%,
    60% {
        transform: translate3d(4px, 0, 0);
    }
}

/* Стили для мобильной версии */
@media (max-width: 768px) {
    .bot-message,
    .user-message {
        max-width: 90% !important;
    }

    /* Убираем лишние отступы на мобильных */
    .fixed.inset-0 > div {
        margin: 0 !important;
    }
}

/* Плавная анимация скролла */
.overflow-y-auto {
    scroll-behavior: smooth;
}

/* Стилизация скроллбара */
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
