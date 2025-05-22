import { storeToRefs } from "pinia"
import { useMediaListStore } from "@/entities/media-list"
import { computed, onMounted } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { useTrackStore } from "@/entities/track"
import { useCurrentUser } from "@/features/auth/current-user"

export const useFavoriteTracks = () => {
    const trackStore = useTrackStore()
    const { getManyById: getManyTracksById } = storeToRefs(trackStore)

    const mediaListStore = useMediaListStore()
    const { getFavoriteTracksMediaListId, getMediaListById } = storeToRefs(mediaListStore)

    const { data: user } = useCurrentUser()

    const mediaListId = computed(() => {
        return getFavoriteTracksMediaListId.value
    })

    const data = computed(() => {
        return getMediaListById.value(mediaListId.value)
    })

    const tracks = computed(() => {
        if (data.value === undefined) return []

        return getManyTracksById.value(data.value.items)
    })

    const hasMore = computed((): boolean | undefined => {
        if (data.value === undefined) return undefined

        return data.value.items.length < data.value.count
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.collection.getFavoriteTracks(tracks.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            trackStore.addItems(data.tracks)

            mediaListStore.addItemsToMediaList({
                id: mediaListId.value,
                items: data.tracks.map(item => item.id),
                count: user.value.favorite_tracks_count,
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
        data: tracks,
        isLoading,
        hasMore,
        getMore,
    }
}
