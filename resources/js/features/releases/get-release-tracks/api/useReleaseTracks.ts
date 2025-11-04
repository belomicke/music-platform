import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useReleaseTrackListStore } from "@/entities/release-tracks"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useReleaseTracks = (id: ComputedRef<string>) => {
    const trackStore = useTrackStore()
    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const { getSeveralTracks } = storeToRefs(trackStore)

    const releaseTrackListStore = useReleaseTrackListStore()

    const releaseTrackList = computed(() => {
        return releaseTrackListStore.getReleaseTracks(id.value)
    })

    const tracks = computed(() => {
        return getSeveralTracks.value(releaseTrackList.value.tracks)
    })

    const count = computed(() => {
        return releaseTrackList.value.count
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.releases.tracks(id.value, tracks.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            const tracks = data.tracks
            const artists = tracks.map(track => track.artists).flat(1)
            const releases = tracks.map(track => track.release)

            artistStore.addItems(artists)
            releaseStore.addItems(releases)
            trackStore.addItems(tracks)
            releaseTrackListStore.addReleaseTracks({
                id: id.value,
                tracks: tracks.map(track => track.id),
                count: data.count,
            })
        },
    })

    onMounted(async () => {
        if (tracks.value.length === 0) {
            await fetch()
        }
    })

    return {
        data: tracks,
        count,
        fetch,
        isLoading,
    }
}
