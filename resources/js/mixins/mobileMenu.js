import { useAppStore } from '../store/AppStore';

export const mobileMenuMixin = {
    methods: {
        toggleMobileMenu() {
            const appStore = useAppStore();
            appStore.toggleMobileMenu();
        }
    }
};

