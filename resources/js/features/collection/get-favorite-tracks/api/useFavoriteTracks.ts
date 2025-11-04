import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCurrentUser } from "@/features/auth/current-user"
import { useCollectionStore } from "@/entities/collection"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteTracks = () => {
    const trackStore = useTrackStore()
    const { getSeveralTracks } = storeToRefs(trackStore)

    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const collectionStore = useCollectionStore()
    const { getFavoriteTracks, getTracksCount } = storeToRefs(collectionStore)

    const { data: user } = useCurrentUser()

    const tracks = computed(() => {
        return getSeveralTracks.value(getFavoriteTracks.value)
    })

    const count = computed(() => {
        return user.value.favorite_tracks_count
    })

    const hasMore = computed((): boolean => {
        return tracks.value.length < count.value
    })

    const after = computed(() => {
        if (tracks.value.length === 0) return ""

        return tracks.value.at(-1).id
    })

    const { fetch, isLoading } = useFetch(async (after: string) => {
        return await api.collection.getFavoriteTracks(after)
    }, {
        onSuccess: (res) => {
            const data = res.data.data
            const tracks = data.tracks

            artistStore.addItems(tracks.map(track => track.artists).flat(1))
            releaseStore.addItems(tracks.map(track => track.release).flat(1))
            trackStore.addItems(tracks)

            collectionStore.addTracks(data.tracks.map(track => track.id))
            collectionStore.setTracksCount(data.count)
        },
    })

    onMounted(async () => {
        if (user.value.favorite_tracks_count !== getTracksCount.value) {
            await fetch(after.value)
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch(after.value)
    }

    return {
        data: tracks,
        count,
        fetch,
        isLoading,
        hasMore,
        getMore,
    }
}
