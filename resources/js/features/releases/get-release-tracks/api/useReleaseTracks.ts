import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useReleaseTracks = (id: ComputedRef<string>, options?: { load_on_mounted?: boolean }) => {
    const trackStore = useTrackStore()
    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const { getById: getReleaseById } = storeToRefs(releaseStore)
    const { getManyById: getManyTracksById } = storeToRefs(trackStore)

    const release = computed(() => {
        if (id.value === undefined) return undefined

        return getReleaseById.value(id.value)
    })

    const tracks = computed(() => {
        if (release.value === undefined) return []

        const result = getManyTracksById.value(release.value.tracks)

        if (result.indexOf(undefined) !== -1) {
            return []
        }

        return result
    })

    const count = computed(() => {
        return release.value?.track_count
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.releases.tracks(id.value, tracks.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            const tracks = data.tracks
            const artists = tracks.map(track => track.artists).flat(1)
            const releases = tracks.map(track => track.releases).flat(1)

            trackStore.addItems(tracks)
            artistStore.addItems(artists)
            releaseStore.addItems(releases)
        },
    })

    onMounted(async () => {
        if (options && options.load_on_mounted === false) return

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
