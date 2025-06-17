import { onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useRecentSearchStore } from "@/entities/recent-search"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { api, ApiArtist, ApiRelease } from "@/shared/api"
import { useFetch } from "@/shared/hooks"

export const useRecentSearches = () => {
    const recentSearchStore = useRecentSearchStore()
    const { getRecentSearches } = storeToRefs(recentSearchStore)

    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const { fetch, isLoading } = useFetch(async () => {
        return api.recent_searches.get()
    }, {
        onSuccess: (res) => {
            const data = res.data.data.recent_searches

            recentSearchStore.addItems(data)

            const artists = data
                .filter(item => item.type === "artist")
                .map(item => item.data as ApiArtist)
            artistStore.addItems(artists)

            const releases = data
                .filter(item => item.type === "release")
                .map(item => item.data as ApiRelease)
            releaseStore.addItems(releases)
        },
    })

    onMounted(async () => {
        if (getRecentSearches.value.length > 0) return

        await fetch()
    })

    return {
        data: getRecentSearches,
        isLoading,
    }
}
