<template>
    <transition name="modal">
        <div v-if="modelValue" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <!-- Кнопка закрытия -->
                    <button @click="close" class="absolute right-4 top-4 text-gray-400 hover:text-gray-500">
                        <span class="mdi mdi-close text-xl"></span>
                    </button>

                    <!-- Заголовок -->
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900 mb-4">
                            <slot name="header"></slot>
                        </h3>
                        
                        <!-- Основной контент -->
                        <div class="mt-2">
                            <slot></slot>
                        </div>
                    </div>

                    <!-- Футер с кнопками -->
                    <div v-if="$slots.footer" class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: 'BaseModal',
    props: {
        modelValue: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        close() {
            this.$emit('update:modelValue', false)
        }
    }
}
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active .relative,
.modal-leave-active .relative {
    transition: transform 0.3s ease;
}

.modal-enter-from .relative,
.modal-leave-to .relative {
    transform: scale(0.95);
}
</style>
