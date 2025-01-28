/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { modalMixin } from './mixins/modal';

const pinia = createPinia();

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(pinia);
app.mixin(modalMixin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

// Мобильное меню
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const menuIcon = mobileMenuButton.querySelector('.menu-icon');
    const closeIcon = mobileMenuButton.querySelector('.close-icon');

    function openMenu() {
        mobileMenu.classList.remove('transform', 'translate-y-full');
        mobileMenu.classList.add('translate-y-0');
        menuIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
        body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.remove('translate-y-0');
        mobileMenu.classList.add('transform', 'translate-y-full');
        menuIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
        body.style.overflow = '';
    }

    mobileMenuButton.addEventListener('click', openMenu);
    mobileMenuClose.addEventListener('click', closeMenu);

    // Обработка выпадающего списка услуг
    const servicesDropdowns = document.querySelectorAll('.services-dropdown');
    servicesDropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const content = dropdown.querySelector('.services-content');
        const chevron = button.querySelector('.mdi-chevron-down');

        button.addEventListener('click', () => {
            content.classList.toggle('hidden');
            chevron.style.transform = content.classList.contains('hidden') ? '' : 'rotate(180deg)';
        });
    });
});
