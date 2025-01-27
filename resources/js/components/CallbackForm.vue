<template>
    <base-modal v-model="isOpen" @update:modelValue="$emit('update:modelValue', $event)">
        <template #header>
            Заказать звонок
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
                <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                <input 
                    type="tel" 
                    id="phone" 
                    v-model="form.phone"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{ 'border-red-300': errors.phone }"
                    required
                >
                <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
            </div>

            <div>
                <label for="time" class="block text-sm font-medium text-gray-700">Удобное время для звонка</label>
                <select 
                    id="time" 
                    v-model="form.time"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    :class="{ 'border-red-300': errors.time }"
                >
                    <option value="">Выберите время</option>
                    <option value="morning">Утро (9:00 - 12:00)</option>
                    <option value="afternoon">День (12:00 - 17:00)</option>
                    <option value="evening">Вечер (17:00 - 21:00)</option>
                </select>
                <p v-if="errors.time" class="mt-1 text-sm text-red-600">{{ errors.time }}</p>
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea 
                    id="comment" 
                    v-model="form.comment"
                    rows="3"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                ></textarea>
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
                {{ loading ? 'Отправка...' : 'Заказать звонок' }}
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
    name: 'CallbackForm',
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
            form: {
                name: '',
                phone: '',
                time: '',
                comment: '',
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
    methods: {
        async submitForm() {
            this.loading = true
            this.errors = {}

            try {
                const response = await axios.post('/api/callback', this.form)
                this.$emit('update:modelValue', false)
                // Показываем уведомление об успехе
                this.$emit('success', 'Заявка успешно отправлена')
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
