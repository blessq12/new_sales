<script>
import { useAppStore } from '@/store/AppStore';
import { mapStores } from 'pinia';
import * as yup from 'yup';

export default {
    computed: {
        ...mapStores(useAppStore),
        type() {
            if (this.form.subject === 'Вопрос') {
                return 'question';
            } else if (this.form.subject === 'Предложение') {
                return 'offer';
            } else if (this.form.subject === 'Сотрудничество') {
                return 'cooperation';
            } else if (this.form.subject === 'Другое') {
                return 'other';
            }
        }
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                message: '',
                subject: 'Вопрос',
                phone: '',
                privacyPolicy: true
            },
            subjects: ['Вопрос', 'Предложение', 'Сотрудничество', 'Другое'],
            loading: false,
            schema: yup.object().shape({
                name: yup.string().required('Имя обязательно'),
                email: yup.string().email('Неверный email').required('Email обязателен'),
                message: yup.string().required('Сообщение обязательно'),
                subject: yup.string().required('Тема обязательна'),
                phone: yup.string().required('Номер телефона обязателен').min(18, 'Некорректный номер телефона'),
                privacyPolicy: yup.boolean().oneOf([true], 'Необходимо согласие на обработку персональных данных')
            })
        }
    },
    methods: {
        submitForm() {
            if (this.loading) return;
            this.loading = true;
            this.schema.validate(this.form, { abortEarly: false })
                .then((valid) => {
                    let requestData = {
                        type: this.type,
                        data: this.form
                    };
                    axios.post('/api/user-requests/contact-form', requestData)
                        .then((response) => {
                            this.clearForm();
                            this.appStore.showToast('success', 'Сообщение успешно отправлено!');
                        })
                        .catch((error) => {
                            this.appStore.showToast('error', 'Произошла ошибка при отправке сообщения');
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                })
                .catch((error) => {
                    error.inner.forEach(err => {
                        this.appStore.showToast('error', err.message);
                    });
                }).finally(() => {
                    this.loading = false;
                });
        },
        clearForm() {
            this.form = {
                name: '',
                email: '',
                message: '',
                subject: 'Вопрос',
                phone: '',
                privacyPolicy: true
            };
        }
    }
}
</script>

<template>
    <form class="mt-6 space-y-6" @submit.prevent="submitForm">
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Имя</label>
            <input type="text" id="name" name="name"  v-model="form.name"
                   class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
        <div>
            <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Тема</label>
            <select id="subject" v-model="form.subject"  
                   class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                   list="subjectsList">
                <option v-for="subject in subjects" :key="subject" :value="subject">{{ subject }}</option>
            </select>
        </div>
        <div class="flex space-x-4">
            <div class="flex-1">
                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Номер телефона</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone"  
                    v-model="form.phone" 
                    v-maska data-maska="+7 (###) ###-##-##"
                    class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                >
            </div>
            <div class="flex-1">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <input type="email" id="email" name="email"  v-model="form.email"
                       class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div>
            <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Сообщение</label>
            <textarea id="message" name="message" rows="4"  v-model="form.message"
                      class="mt-2 block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
        </div>
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input 
                    id="privacyPolicy" 
                    type="checkbox" 
                    v-model="form.privacyPolicy"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-indigo-300"
                >
            </div>
            <div class="ml-3 text-sm">
                <label for="privacyPolicy" class="font-medium text-gray-700">
                    Я согласен на обработку персональных данных
                </label>
            </div>
        </div>
        <button type="submit" 
                class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200">
            Отправить сообщение
        </button>
    </form>
</template>