import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useArtistStore } from "@/entities/artist"
import { useMediaListStore } from "@/entities/media-list"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const usePopularArtists = () => {
    const artistStore = useArtistStore()
    const { getManyById: getManyArtistsById } = storeToRefs(artistStore)

    const mediaListStore = useMediaListStore()
    const { getMediaListById, getPopularArtistsMediaListId } = storeToRefs(mediaListStore)

    const mediaList = computed(() => {
        return getMediaListById.value(getPopularArtistsMediaListId.value)
    })

    const artists = computed(() => {
        if (mediaList.value === undefined) return []

        return getManyArtistsById.value(mediaList.value.items)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.getPopular()
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            artistStore.addItems(data.artists)

            mediaListStore.addItemsToMediaList({
                id: getPopularArtistsMediaListId.value,
                items: data.artists.map(item => item.id),
                count: data.count,
            })
        },
    })

    onMounted(async () => {
        if (mediaList.value === undefined) {
            await fetch()
        }
    })

    return {
        data: artists,
        isLoading,
    }
}
