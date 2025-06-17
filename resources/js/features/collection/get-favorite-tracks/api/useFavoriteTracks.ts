import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCurrentUser } from "@/features/auth/current-user"
import { useMediaListStore } from "@/entities/media-list"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteTracks = (options?: { load_on_mounted?: boolean }) => {
    const trackStore = useTrackStore()
    const { getManyById: getManyTracksById } = storeToRefs(trackStore)

    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

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

    const count = computed(() => {
        return user.value.favorite_tracks_count
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
            const tracks = data.tracks

            artistStore.addItems(tracks.map(track => track.artists).flat(1))
            releaseStore.addItems(tracks.map(track => track.releases).flat(1))
            trackStore.addItems(tracks)

            mediaListStore.addItemsToMediaList({
                id: mediaListId.value,
                items: tracks.map(item => item.id),
                count: user.value.favorite_tracks_count,
            })
        },
    })

    onMounted(async () => {
        if (options && options.load_on_mounted === false) return

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
        count,
        fetch,
        isLoading,
        hasMore,
        getMore,
    }
}
