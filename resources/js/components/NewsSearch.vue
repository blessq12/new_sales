<template>
    <div>
        <div class="relative">
            <div
                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
            >
                <span class="mdi mdi-magnify text-gray-400"></span>
            </div>
            <input
                type="text"
                v-model="searchQuery"
                @input="handleSearch"
                placeholder="Поиск по новостям..."
                class="block w-full rounded-xl border-0 py-3 pl-10 pr-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
            />
        </div>

        <div
            v-if="showResults && results.length > 0"
            class="absolute z-10 mt-2 w-full rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 max-h-[500px] overflow-y-auto"
        >
            <div class="p-4 space-y-4">
                <a
                    v-for="article in results"
                    :key="article.id"
                    :href="article.url"
                    class="block group"
                >
                    <div class="flex gap-4">
                        <div class="w-20 h-20">
                            <img
                                :src="article.image"
                                :alt="article.title"
                                class="w-full h-full object-cover rounded-lg"
                            />
                        </div>
                        <div class="flex-1">
                            <span
                                class="inline-flex items-center rounded-md bg-indigo-500/10 px-2 py-1 text-xs font-medium text-indigo-600 ring-1 ring-inset ring-indigo-500/20 mb-1"
                            >
                                {{ article.category }}
                            </span>
                            <h4
                                class="font-semibold mb-1 group-hover:text-indigo-600 transition-all duration-200"
                            >
                                {{ article.title }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-1">
                                {{ article.description }}
                            </p>
                            <div class="text-sm text-gray-500">
                                {{ article.date }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div
            v-else-if="showResults && searchQuery"
            class="absolute z-10 mt-2 w-full rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5"
        >
            <div class="p-4 text-center text-gray-500">Ничего не найдено</div>
        </div>
    </div>
</template>

<script>
import debounce from "lodash/debounce";
import { onMounted, onUnmounted, ref } from "vue";

export default {
    name: "NewsSearch",
    setup() {
        const searchQuery = ref("");
        const results = ref([]);
        const showResults = ref(false);

        // Создаем дебаунсированную функцию поиска
        const debouncedSearch = debounce(async (query) => {
            if (!query) {
                results.value = [];
                return;
            }

            try {
                const response = await fetch(
                    `/api/search/news?q=${encodeURIComponent(query)}`
                );
                const data = await response.json();
                results.value = data.articles;
            } catch (error) {
                console.error("Ошибка при поиске:", error);
                results.value = [];
            }
        }, 300);

        const handleSearch = () => {
            showResults.value = true;
            debouncedSearch(searchQuery.value);
        };

        // Закрываем результаты при клике вне компонента
        const handleClickOutside = (event) => {
            if (!event.target.closest(".search-container")) {
                showResults.value = false;
            }
        };

        onMounted(() => {
            document.addEventListener("click", handleClickOutside);
        });

        onUnmounted(() => {
            document.removeEventListener("click", handleClickOutside);
        });

        return {
            searchQuery,
            results,
            showResults,
            handleSearch,
        };
    },
};
</script>
