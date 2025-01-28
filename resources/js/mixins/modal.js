import { useAppStore } from '../store/AppStore';

export const modalMixin = {
    methods: {
        openModal(name) {
            const appStore = useAppStore();
            appStore.openModal(name);
        }
    }
};
