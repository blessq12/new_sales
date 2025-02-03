<script>
import * as yup from 'yup';
import { useAppStore } from '../store/AppStore';
import { mapStores } from 'pinia';

export default {
    computed: {
        ...mapStores(useAppStore)
    },
    props: {
        serviceId: {
            type: Number,
            required: true
        },
        serviceName: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            form: {
                name: '',
                phone: '',
                message: '',
                type: 'order',
                agree: true,
                service_id: this.serviceId,
                service_name: this.serviceName
            },
            schema: yup.object().shape({
                name: yup.string().required('Имя обязательно'),
                phone: yup.string().required('Телефон обязательно').min(18, 'Некорректный номер телефона'),
                message: yup.string().required('Сообщение обязательно')
            })
        }
    },
    methods: {
        submitForm() {
            this.schema.validate(this.form , { abortEarly: false })
                .then((valid) => {
                    let requestData = {
                        type: this.form.type,
                        data: this.form
                    };
                    axios.post('/api/user-requests/store', requestData)
                        .then((res) => {
                            this.appStore.showToast('success', 'Ваша заявка упешна отправлена, наш менеджер скоро свяжется с вами');
                            this.clearForm();
                        })
                        .catch((error) => {
                            this.appStore.showToast('error', 'Произошла ошибка при отправке заявки');
                        });
                })
                .catch((error) => {
                    error.inner.forEach(err => {
                        this.appStore.showToast('error', err.message);
                    });
                });
        },
        clearForm() {
            this.form = {
                name: '',
                phone: '',
                message: '',
                type: 'order',
                agree: true,
                service_id: this.serviceId,
                service_name: this.serviceName
            };
        }
    }
}
</script>

<template>
    <form class="mx-auto mt-10 max-w-md" @submit.prevent="submitForm">
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        <div class="grid grid-cols-1 gap-x-8 gap-y-6">
            <div>
                <label for="name" class="block text-sm font-semibold leading-6 text-white">Ваше имя</label>
                <div class="mt-2.5">
                    <input type="text" 
                           name="name" 
                           id="name" 
                           v-model="form.name" 
                           class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="phone" class="block text-sm font-semibold leading-6 text-white">Телефон</label>
                <div class="mt-2.5">
                    <input type="tel" 
                           name="phone" 
                           id="phone" 
                           v-model="form.phone" 
                           v-maska
                           data-maska="+7 (###) ###-##-##"
                           class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm font-semibold leading-6 text-white">Сообщение</label>
                <div class="mt-2.5">
                    <textarea name="message" 
                              id="message" 
                              v-model="form.message" 
                              rows="4" 
                              class="block w-full rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>
            <div>
                <label for="consent" class="flex items-center justify-center text-sm font-semibold leading-6 text-white">
                    <input type="checkbox" 
                           id="consent" 
                           v-model="form.agree" 
                           class="mr-2">
                    Я согласен на обработку персональных данных
                </label>
            </div>
        </div>
        <div class="mt-8 flex justify-center">
            <button type="submit" 
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Отправить заявку
            </button>
        </div>
    </form>
</template>

<style lang="sass" scoped>
</style>