import { acceptHMRUpdate, defineStore } from "pinia";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
const toast = useToast({
    position: "top-right",
    duration: 3000,
});

export const useAppStore = defineStore("app", {
    state: () => ({
        activeModal: null,
        modals: {
            callback: false,
            review: false,
        },
        lastSearchQuery: null,
        cookieConsent: localStorage.getItem("cookieConsent") === "true",
        mobileMenu: false,
    }),

    actions: {
        toggleMobileMenu() {
            this.mobileMenu = !this.mobileMenu;
        },
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
            Object.keys(this.modals).forEach((key) => {
                this.modals[key] = false;
            });
            this.activeModal = null;
        },

        // Управление куки
        acceptCookies() {
            this.cookieConsent = true;
            localStorage.setItem("cookieConsent", "true");
        },

        // Проверка состояния модального окна
        isModalOpen(modalName) {
            return this.modals[modalName] || false;
        },
        showToast(type, message) {
            toast[type](message);
        },

        async search(query) {
            const response = await axios.get("/api/search", {
                params: { q: query },
            });
            return response.data;
        },
    },

    getters: {
        currentModal: (state) => state.activeModal,
        hasOpenModal: (state) =>
            Object.values(state.modals).some((isOpen) => isOpen),
        hasCookieConsent: (state) => state.cookieConsent,
    },
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useAppStore, import.meta.hot));
}
