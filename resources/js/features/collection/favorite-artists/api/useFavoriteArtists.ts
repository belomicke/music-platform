import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCompactArtistStore } from "@/entities/artist"
import { useMediaListStore } from "@/entities/media-list"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteArtists = (id: ComputedRef<string>) => {
    const compactArtistStore = useCompactArtistStore()
    const { getManyById: getManyCompactArtistsById } = storeToRefs(compactArtistStore)

    const mediaListStore = useMediaListStore()
    const { getFavoriteArtistsMediaListId, getMediaListById } = storeToRefs(mediaListStore)

    const mediaListId = computed(() => {
        return getFavoriteArtistsMediaListId.value
    })

    const data = computed(() => {
        return getMediaListById.value(mediaListId.value)
    })

    const artists = computed(() => {
        if (data.value === undefined) return []

        return getManyCompactArtistsById.value(data.value.items)
    })

    const hasMore = computed((): boolean | undefined => {
        if (data.value === undefined) return undefined

        return data.value.items.length < data.value.count
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.getFavorite(artists.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            compactArtistStore.addItems(data.artists)

            mediaListStore.addItemsToMediaList({
                id: mediaListId.value,
                items: data.artists.map(item => item.id),
                count: data.count,
            })
        },
    })

    onMounted(async () => {
        if (data.value === undefined) {
            await fetch()
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch()
    }

    return {
        mediaListId,
        data: artists,
        isLoading,
        hasMore,
        getMore,
    }
}
