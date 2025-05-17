import { useRecentSearchStore } from "@/entities/recent-search"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useClearRecentSearches = () => {
    const recentSearchStore = useRecentSearchStore()

    return useFetch(async () => {
        return api.recent_searches.clear()
    }, {
        onSuccess: () => {
            recentSearchStore.clear()
        },
    })
}
