<script>
import * as yup from "yup";

export default {
    name: "OrderParts",
    mounted() {
        //
    },
    data() {
        return {
            yupObject: this.getYupObject(),
            form: {
                name: "",
                phone: "",
                article: "",
                message: "",
                file: null,
            },
            previewImage: null,
            isSubmitting: false,
            submitMessage: "",
        };
    },
    methods: {
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith("image/")) {
                this.form.file = file;
                this.previewImage = URL.createObjectURL(file); // Предпросмотр изображения
            } else {
                this.form.file = null;
                this.previewImage = null;
                alert("Пожалуйста, выберите изображение (PNG, JPG).");
            }
        },
        submitForm() {
            this.yupObject
                .validate(this.form, { abortEarly: false })
                .then((res) => {
                    const formData = new FormData();
                    formData.append("name", res.name);
                    formData.append("phone", res.phone);
                    formData.append("article", res.article);
                    formData.append("message", res.message);
                    if (this.form.file) {
                        formData.append("file", this.form.file);
                    }

                    axios
                        .post(
                            "/api/notifications/send-parts-request",
                            formData,
                            {
                                headers: {
                                    "Content-Type": "multipart/form-data",
                                },
                            }
                        )
                        .then((res) => {
                            this.$toast.success(res.data.message);
                            this.resetForm();
                        })
                        .catch((error) => {
                            this.$toast.error(error.response.data.message);
                        });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        resetForm() {
            this.form = {
                name: "",
                phone: "",
                article: "",
                message: "",
                file: null,
            };
            this.previewImage = null;
        },
        getYupObject() {
            return yup.object().shape({
                name: yup.string().required("Имя обязательно"),
                phone: yup.string().required("Телефон обязательно"),
                article: yup.string().optional(),
                message: yup.string().optional(),
            });
        },
    },
};
</script>

<template>
    <div class="py-12 max-w-4xl mx-auto bg-gray-50 rounded-xl p-6 shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl md:text-5xl font-bold text-gray-800 mb-4">
                    Закажите запчасти GROHE
                </h2>
                <p class="text-gray-600">
                    Мы — авторизованный сервис GROHE, работаем с официальными
                    дилерами и предлагаем оригинальные запчасти для всей
                    сантехники GROHE. Укажите артикул или загрузите фото детали!
                </p>
                <ul class="mt-12 space-y-3">
                    <li>
                        <span class="mdi mdi-check text-green-500"></span>
                        <span> Официальный сервис GROHE </span>
                    </li>
                    <li>
                        <span class="mdi mdi-check text-green-500"></span>
                        <span> Оригинальные запчасти </span>
                    </li>
                    <li>
                        <span class="mdi mdi-check text-green-500"></span>
                        <span> Гарантия на запчасти </span>
                    </li>
                    <li>
                        <span class="mdi mdi-check text-green-500"></span>
                        <span> Поиск по артикулу </span>
                    </li>
                </ul>
            </div>
            <div>
                <form
                    @submit.prevent="submitForm"
                    class="space-y-4"
                    enctype="multipart/form-data"
                >
                    <div>
                        <label for="name" class="block text-gray-700 mb-2"
                            >Имя</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            placeholder="Ваше имя"
                            class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            required
                        />
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 mb-2"
                            >Телефон</label
                        >
                        <input
                            v-model="form.phone"
                            type="tel"
                            id="phone"
                            placeholder="Ваш телефон"
                            v-maska
                            data-maska="+7 (###) ###-##-##"
                            class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>
                    <div>
                        <label for="article" class="block text-gray-700 mb-2">
                            Артикул <small>(если известен)</small> или фото
                        </label>
                        <div class="flex gap-2 items-end">
                            <input
                                v-model="form.article"
                                type="text"
                                id="article"
                                placeholder="Артикул (например, 65655000)"
                                class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                            <label
                                for="file"
                                class="block"
                                @click="this.$refs.file.click()"
                            >
                                <input
                                    type="file"
                                    id="file"
                                    accept="image/*"
                                    ref="file"
                                    class="hidden"
                                    @change="handleFileChange"
                                />
                                <button
                                    type="button"
                                    class="px-3 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                                >
                                    <span class="mdi mdi-file-upload"></span>
                                </button>
                            </label>
                        </div>
                        <!-- Предпросмотр изображения -->
                        <div v-if="previewImage" class="mt-4">
                            <img
                                :src="previewImage"
                                alt="Preview"
                                class="max-w-xs rounded-md"
                            />
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-gray-700 mb-2"
                            >Сообщение</label
                        >
                        <textarea
                            v-model="form.message"
                            id="message"
                            placeholder="Ваше сообщение (необязательно)"
                            class="block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            rows="4"
                        ></textarea>
                    </div>
                    <div class="flex justify-start items-center">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                            :disabled="isSubmitting"
                        >
                            {{
                                isSubmitting
                                    ? "Отправка..."
                                    : "Отправить заявку"
                            }}
                        </button>
                    </div>
                    <p
                        v-if="submitMessage"
                        ref="submitMessage"
                        class="text-green-600 text-sm"
                    >
                        {{ submitMessage }}
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
