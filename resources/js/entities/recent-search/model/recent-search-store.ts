import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiRecentSearch, RecentSearchType } from "@/shared/api"

export interface RecentSearch {
    id: string
    type: RecentSearchType
}

export const useRecentSearchStore = defineStore("recent-searches", () => {
    const recentSearches = ref<RecentSearch[]>([])

    const getRecentSearches = computed(() => recentSearches.value)

    const addItem = (id: string, type: RecentSearchType) => {
        const recentSearch = recentSearches.value.find(item => item.id === id && item.type === type)

        if (recentSearch) return

        recentSearches.value.unshift({
            id,
            type,
        })
    }

    const addItems = (items: ApiRecentSearch[]) => {
        items.forEach(item => addItem(item.data.id, item.type))
    }

    const clear = () => {
        recentSearches.value = []
    }

    return {
        getRecentSearches,

        addItem,
        addItems,

        clear,
    }
})
