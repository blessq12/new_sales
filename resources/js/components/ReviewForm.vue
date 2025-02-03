<script>
import { ref, computed } from 'vue';
import { useAppStore } from '../store/AppStore';
import BaseModal from './BaseModal.vue';
import * as yup from 'yup';

export default {
    name: 'ReviewForm',
    components: {
        BaseModal
    },
    setup() {
        const appStore = useAppStore();
        const loading = ref(false);
        const errors = ref({});
        const services = ref([]);

        const form = ref({
            name: '',
            service_id: '',
            rating: 0,
            message: '',
            agree_to_process_personal_data: true
        });

        const isOpen = computed(() => appStore.isModalOpen('review'));

        const resetForm = () => {
            form.value = {
                name: '',
                service_id: '',
                rating: 0,
                text: '',
                privacy: false
            };
            errors.value = {};
        };

        const handleModelValue = (value) => {
            if (!value) {
                appStore.closeModal('review');
                resetForm();
            }
        };

        const closeModal = () => {
            appStore.closeModal('review');
            resetForm();
        };

        const loadServices = async () => {
            try {
                const response = await fetch('/api/services');
                if (!response.ok) {
                    throw new Error('Ошибка загрузки услуг');
                }
                services.value = await response.json();
            } catch (error) {
                appStore.showToast('error', 'Ошибка загрузки услуг');
            }
        };

        const validationSchema = yup.object().shape({
            name: yup.string().required('Ваше имя обязательно для заполнения'),
            service_id: yup.string().required('Выберите услугу'),
            rating: yup.number().min(1, 'Оценка должна быть не менее 1').required('Оценка обязательна'),
            message: yup.string().required('Ваш отзыв обязателен для заполнения'),
            agree_to_process_personal_data: yup.boolean().oneOf([true], 'Необходимо согласие на обработку персональных данных')
        });

        const submitForm = async () => {
            if (loading.value) return;

            loading.value = true;
            errors.value = {};

            try {
                await validationSchema.validate(form.value, { abortEarly: false }).then (()=>{
                    axios.post('/api/reviews/store', form.value).then((res)=>{
                        closeModal();
                        appStore.showToast('success', 'Отзыв успешно отправлен. Он будет опубликован после модерации.');
                        resetForm();
                        loading.value = false;
                    }).catch((error)=>{
                        appStore.showToast('error', 'Произошла ошибка при отправке формы');
                        loading.value = false;
                    });
                });
            } catch (validationError) {
                if (validationError.inner) {
                    validationError.inner.forEach(err => {
                        appStore.showToast('error', err.message);
                        loading.value = false;
                    });
                } else {
                    appStore.showToast('error', 'Произошла ошибка при валидации формы');
                }
            }
        };

        // Загружаем список услуг при создании компонента
        loadServices();

        return {
            form,
            loading,
            errors,
            services,
            isOpen,
            submitForm,
            closeModal,
            handleModelValue
        };
    }
}
</script>

<template>
    <base-modal 
        v-model="isOpen" 
        name="review"
        @update:modelValue="handleModelValue"
    >
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
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
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
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
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
                    v-model="form.message"
                    rows="4"
                    class="mt-1 py-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
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
                        v-model="form.agree_to_process_personal_data"
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
                @click="closeModal"
                type="button"
                class="inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
            >
                Отмена
            </button>
        </template>
    </base-modal>
</template>

<style lang="sass"scoped>
input[type="text"],input[type="tel"]
    min-height: 40px
</style>

