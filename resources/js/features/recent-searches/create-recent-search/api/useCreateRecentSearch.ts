import { storeToRefs } from "pinia"
import { useRecentSearchStore } from "@/entities/recent-search"
import { api, RecentSearchType } from "@/shared/api"
import { useFetch } from "@/shared/hooks"

interface params {
    id: string,
    type: RecentSearchType
}

export const useCreateRecentSearch = () => {
    const recentSearchStore = useRecentSearchStore()
    const { getRecentSearches } = storeToRefs(recentSearchStore)

    const { fetch, isLoading } = useFetch(async ({ id, type }: params) => {
        return await api.recent_searches.create(id, type)
    }, {
        onSuccess: (res, params) => {
            if (res.data.success) {
                recentSearchStore.addItem(params.id, params.type)
            }
        },
    })

    const fetchHandler = async (params: params) => {
        const recentSearch = getRecentSearches.value.find(item => item.id === params.id && item.type === params.type)

        if (recentSearch) return
        
        await fetch(params)
    }

    return {
        fetch: fetchHandler,
        isLoading,
    }
}
