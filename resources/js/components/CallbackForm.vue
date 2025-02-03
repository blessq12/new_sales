<script>
import { ref, computed } from 'vue';
import { useAppStore } from '../store/AppStore';
import BaseModal from './BaseModal.vue';
import * as yup from 'yup';

export default {
    name: 'CallbackForm',
    components: {
        BaseModal
    },
    setup() {
        const appStore = useAppStore();
        const loading = ref(false);
        const errors = ref({});

        const form = ref({
            name: '',
            phone: '',
            comment: '',
            agree: true,
            type: 'callback'
        });

        const isOpen = computed(() => appStore.isModalOpen('callback'));

        const resetForm = () => {
            form.value = {
                name: '',
                phone: '',
                comment: '',
                agree: true,
                type: 'callback'
            };
            errors.value = {};
        };

        const handleModelValue = (value) => {
            if (!value) {
                appStore.closeModal('callback');
                resetForm();
            }
        };

        const closeModal = () => {
            appStore.closeModal('callback');
            resetForm();
        };

        const validationSchema = yup.object().shape({
            name: yup.string().required('Имя обязательно для заполнения'),
            phone: yup.string().required('Телефон обязателен для заполнения'),
            agree: yup.boolean().oneOf([true], 'Необходимо согласие на обработку данных')
        });

        const submitForm = async () => {
            if (loading.value) return;

            loading.value = true;
            errors.value = {};

            try {
                await validationSchema.validate(form.value, { abortEarly: false }).then(() => {
                    const requestData = {
                        type: form.value.type,
                        data: {
                            name: form.value.name,
                            phone: form.value.phone,
                            agree: form.value.agree,
                            comment: form.value.comment
                        }
                    };
                    axios.post('/api/user-requests/store', requestData).then((res) => {
                        closeModal();
                        appStore.showToast('success', 'Форма успешно отправлена. Мы свяжемся с вами в указанное время.');
                    }).catch((error) => {
                        console.log(error);
                        appStore.showToast('error', 'Произошла ошибка при отправке формы. Попробуйте позже.');
                    });
                });
            } catch (validationError) {
                if (validationError.inner) {
                    validationError.inner.forEach(err => {
                        appStore.showToast('error', err.message);
                    });
                } else {
                    this.appStore.showToast('error', 'Произошла ошибка при валидации формы');
                }
            } finally {
                loading.value = false;
            }
        };

        return {
            form,
            loading,
            errors,
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
        name="callback"
        @update:modelValue="handleModelValue"
    >
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
                    class="mt-1 block w-full rounded-xl border-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
                    :class="{ 'border-red-300': errors.name }"
                    required
                >
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                <input 
                    type="tel" 
                    id="phone"
                    v-maska
                    data-maska="+7 (###) ###-##-##"
                    v-model="form.phone"
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
                    :class="{ 'border-red-300': errors.phone }"
                    required
                >
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea 
                    id="comment" 
                    v-model="form.comment"
                    rows="3"
                    class="mt-1 py-2 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-4"
                ></textarea>
            </div>

            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input 
                        type="checkbox" 
                        id="agree" 
                        v-model="form.agree"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        required
                    >
                </div>
                <div class="ml-3 text-sm">
                    <label for="agree" class="font-medium text-gray-700">Согласие на обработку персональных данных</label>
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
                @click="closeModal"
                type="button"
                class="inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
            >
                Отмена
            </button>
        </template>
    </base-modal>
</template>

<style lang="sass" scoped>
input[type="text"], input[type="tel"]
    min-height: 45px
</style>
