import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import _ from "lodash"
import { useCompactArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useTracks = (ids: ComputedRef<string[]>) => {
    const compactArtistStore = useCompactArtistStore()
    const releaseStore = useReleaseStore()
    const trackStore = useTrackStore()

    const { getManyById: getTracks } = storeToRefs(trackStore)

    const tracks = computed(() => {
        return getTracks.value(ids.value)
    })

    const tracksToFetch = computed(() => {
        const result: string[] = []

        tracks.value.forEach((track, index) => {
            if (track === undefined) {
                result.push(ids.value[index])
            }
        })

        return result
    })

    watch(tracksToFetch, async () => {
        debounceFetch.cancel()

        if (tracksToFetch.value.length === 0) return

        await debounceFetch()
    })

    onMounted(async () => {
        await debounceFetch()
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.tracks.get(tracksToFetch.value)
    }, {
        onSuccess: (res) => {
            const tracks = res.data.data.tracks

            trackStore.addItems(tracks)

            compactArtistStore.addItems(tracks.map(track => track.artists).flat(1))
            releaseStore.addItems(tracks.map(track => track.releases).flat(1))
        },
    })

    const debounceFetch = _.debounce(async () => {
        await fetch()
    })

    return {
        data: tracks,
        isLoading,
    }
}
