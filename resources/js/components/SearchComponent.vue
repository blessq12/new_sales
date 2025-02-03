<script>
// types [mobile, desktop]
import { useAppStore } from '../store/AppStore';
import { mapStores } from 'pinia';

export default {
    props: {
        type: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            searchQuery: '',
            searchResults: [],
            searchResultsLoading: false
        };
    },
    computed: {
        ...mapStores(useAppStore)
    },
    watch: {
        searchQuery(newVal) {
            this.searchResultsLoading = true;
            this.appStore.search(newVal).then(results => {
                this.searchResults = results;
                this.searchResultsLoading = false;
            });
        }
    }
}
</script>

<template>
    <div class="flex-1 mr-4" v-if="type === 'mobile'">
        <form action="?" method="GET" class="relative" @submit.prevent>
            <input 
                type="text" 
                name="q" 
                placeholder="Поиск по сайту..." 
                class="w-full px-4 py-2 pr-10 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                v-model="searchQuery"
            />
            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                <span class="mdi mdi-magnify text-gray-400"></span>
            </button>
        </form>
        <div v-if="searchQuery" class="results">
            <div class="container mx-auto relative ">
                <div class="absolute mt-4 p-4 top-0 right-0 border-b border-gray-200 w-full border border-gray-200 rounded-lg bg-white overflow-y-auto max-h-[500px]">
                    <p class="p-2">Результаты поиска для: {{ searchQuery }}</p>
                    <div class="mt-2 " v-if="!searchResultsLoading">
                        <ul>
                            <li v-for="result in searchResults.services" :key="result.id" class="flex items-center mb-4">
                                <img :src="result.image" alt="Service Image" class="w-16 h-16 rounded-lg">
                                <div class="ml-4">
                                    <h6 class="text-lg leading-tight font-semibold">{{ result.name }}</h6>
                                    <p class="text-sm text-gray-600">{{ result.description }}</p>
                                    <button class="mt-1 text-blue-500 rounded hover:text-blue-600 hover:underline text-sm">
                                        перейти
                                        <span class="mdi mdi-chevron-right"></span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                        <p class="p-2">Загрузка результатов...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12" v-if="type === 'desktop'">
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="mdi mdi-magnify text-gray-400 text-xl"></span>
            </div>
            <input 
                type="text" 
                class="block w-full rounded-xl border-0 py-4 pl-12 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="Поиск услуги..."
                v-model="searchQuery"
            />
        </div>
        <div v-if="searchQuery" class="results container mx-auto mt-4 p-4 bg-white border border-gray-200 rounded-lg">
            <p class="p-2">Результаты поиска для: {{ searchQuery }}</p>
            <div v-if="!searchResultsLoading">
                <ul>
                    <li v-for="result in searchResults.services" :key="result.id" class="flex items-center mb-4">
                        <img :src="result.image" alt="Service Image" class="w-16 h-16 rounded-lg">
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">{{ result.name }}</h3>
                            <p class="text-sm text-gray-600">{{ result.description }}</p>
                            <button class="mt-1 text-blue-500 rounded hover:text-blue-600 hover:underline text-sm">
                                Перейти на страницу
                                <span class="mdi mdi-chevron-right"></span>
                            </button>
                        </div>
                        
                    </li>
                </ul>
                
            </div>
            <div v-else>
                <p class="p-2">Загрузка результатов...</p>
            </div>
        </div>
    </div>
</template>

<style scoped lang="sass">
</style>
