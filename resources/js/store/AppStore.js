import { defineStore, acceptHMRUpdate } from 'pinia';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
const toast = useToast({
    position: 'top-right',
    duration: 3000,
});

export const useAppStore = defineStore('app', {
    state: () => ({
        // Модальные окна
        activeModal: null,
        modals: {
            callback: false,
            review: false
        },
        
        // Состояние куки
        cookieConsent: localStorage.getItem('cookieConsent') === 'true'
    }),

    actions: {
        // Управление модальными окнами
        openModal(modalName) {
            if (this.modals.hasOwnProperty(modalName)) {
                this.activeModal = modalName;
                this.modals[modalName] = true;
            }
        },

        closeModal(modalName) {
            if (this.modals.hasOwnProperty(modalName)) {
                this.modals[modalName] = false;
                this.activeModal = null;
            }
        },

        closeAllModals() {
            Object.keys(this.modals).forEach(key => {
                this.modals[key] = false;
            });
            this.activeModal = null;
        },

        // Управление куки
        acceptCookies() {
            this.cookieConsent = true;
            localStorage.setItem('cookieConsent', 'true');
        },

        // Проверка состояния модального окна
        isModalOpen(modalName) {
            return this.modals[modalName] || false;
        },
        showToast(type, message) {
            toast[type](message);
        }
    },

    getters: {
        // Получение активного модального окна
        currentModal: (state) => state.activeModal,
        
        // Проверка, открыто ли какое-либо модальное окно
        hasOpenModal: (state) => Object.values(state.modals).some(isOpen => isOpen),
        
        // Получение состояния куки
        hasCookieConsent: (state) => state.cookieConsent
    }
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useAppStore, import.meta.hot));
}