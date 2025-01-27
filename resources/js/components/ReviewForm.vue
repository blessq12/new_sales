<template>
    <base-modal v-model="isOpen" @update:modelValue="$emit('update:modelValue', $event)">
        <template #header>
            Оставить отзыв
        </template>

        <form @submit.prevent="submitForm" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Ваше имя</label>
                <input 
                    type="text" 
                    id="name" 
                    v-model="form.name"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{ 'border-red-300': errors.name }"
                    required
                >
                <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
            </div>

            <div>
                <label for="service" class="block text-sm font-medium text-gray-700">Услуга</label>
                <select 
                    id="service" 
                    v-model="form.service_id"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{ 'border-red-300': errors.service_id }"
                    required
                >
                    <option value="">Выберите услугу</option>
                    <option v-for="service in services" :key="service.id" :value="service.id">
                        {{ service.name }}
                    </option>
                </select>
                <p v-if="errors.service_id" class="mt-1 text-sm text-red-600">{{ errors.service_id }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Оценка</label>
                <div class="flex items-center space-x-2 mt-1">
                    <template v-for="rating in 5" :key="rating">
                        <button 
                            type="button"
                            @click="form.rating = rating"
                            class="text-2xl focus:outline-none"
                            :class="rating <= form.rating ? 'text-yellow-400' : 'text-gray-300'"
                        >
                            <span class="mdi mdi-star"></span>
                        </button>
                    </template>
                </div>
                <p v-if="errors.rating" class="mt-1 text-sm text-red-600">{{ errors.rating }}</p>
            </div>

            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Ваш отзыв</label>
                <textarea 
                    id="text" 
                    v-model="form.text"
                    rows="4"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{ 'border-red-300': errors.text }"
                    required
                ></textarea>
                <p v-if="errors.text" class="mt-1 text-sm text-red-600">{{ errors.text }}</p>
            </div>

            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input 
                        type="checkbox" 
                        id="privacy" 
                        v-model="form.privacy"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        :class="{ 'border-red-300': errors.privacy }"
                        required
                    >
                </div>
                <div class="ml-3 text-sm">
                    <label for="privacy" class="font-medium text-gray-700">Согласие на обработку персональных данных</label>
                    <p v-if="errors.privacy" class="mt-1 text-sm text-red-600">{{ errors.privacy }}</p>
                </div>
            </div>
        </form>

        <template #footer>
            <button 
                @click="submitForm"
                type="submit"
                class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto"
                :disabled="loading"
            >
                <span v-if="loading" class="mdi mdi-loading mdi-spin mr-2"></span>
                {{ loading ? 'Отправка...' : 'Отправить отзыв' }}
            </button>
            <button 
                @click="$emit('update:modelValue', false)"
                type="button"
                class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
            >
                Отмена
            </button>
        </template>
    </base-modal>
</template>

<script>
import BaseModal from './BaseModal.vue'

export default {
    name: 'ReviewForm',
    components: {
        BaseModal
    },
    props: {
        modelValue: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            isOpen: this.modelValue,
            loading: false,
            services: [],
            form: {
                name: '',
                service_id: '',
                rating: 0,
                text: '',
                privacy: false
            },
            errors: {}
        }
    },
    watch: {
        modelValue(val) {
            this.isOpen = val
        }
    },
    async created() {
        try {
            const response = await axios.get('/api/services')
            this.services = response.data
        } catch (error) {
            console.error('Ошибка при загрузке услуг:', error)
        }
    },
    methods: {
        async submitForm() {
            this.loading = true
            this.errors = {}

            try {
                const response = await axios.post('/api/reviews', this.form)
                this.$emit('update:modelValue', false)
                // Показываем уведомление об успехе
                this.$emit('success', 'Спасибо за ваш отзыв!')
            } catch (error) {
                if (error.response?.data?.errors) {
                    this.errors = error.response.data.errors
                }
            } finally {
                this.loading = false
            }
        }
    }
}
</script>
