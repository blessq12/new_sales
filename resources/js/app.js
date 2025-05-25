/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { vMaska } from "maska/vue";
import { createPinia } from "pinia";
import { createApp } from "vue";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import "./bootstrap";
import { mobileMenuMixin } from "./mixins/mobileMenu";
import { modalMixin } from "./mixins/modal";
import { useAppStore } from "./store/AppStore";

const pinia = createPinia();
const toast = useToast({
    position: "top-right",
    duration: 3000,
});

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    setup() {
        const appStore = useAppStore();
        return { appStore };
    },
});

app.use(pinia);
app.directive("maska", vMaska);
app.mixin(modalMixin);
app.mixin(mobileMenuMixin);
app.config.globalProperties.$toast = toast;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.glob("./**/*.vue", { eager: true })).forEach(
    ([path, definition]) => {
        app.component(
            path
                .split("/")
                .pop()
                .replace(/\.\w+$/, ""),
            definition.default
        );
    }
);

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");
