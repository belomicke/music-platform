import { computed } from "vue"
import { storeToRefs } from "pinia"
import { usePlayer, useQueueStore } from "@/entities/player"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { useTrackStore } from "@/entities/track"
import { api, TrackListResponse } from "@/shared/api"

export const useQueue = () => {
    const trackStore = useTrackStore()
    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const queueStore = useQueueStore()
    const { getCurrentQueue, getCurrentQueueId, getCurrentTrackIndex } = storeToRefs(queueStore)

    const id = computed(() => getCurrentQueueId.value.split(":")[1])
    const type = computed(() => getCurrentQueueId.value.split(":")[0])

    const { currentTime, setCurrentTime, setTrack, play } = usePlayer()

    const tracks = computed(() => {
        if (getCurrentQueue.value === undefined) return []

        return getCurrentQueue.value.items
    })

    const count = computed(() => {
        if (getCurrentQueue.value === undefined) return undefined

        return getCurrentQueue.value.count
    })

    const hasMore = computed(() => {
        if (getCurrentQueue.value === undefined) return true

        return getCurrentQueue.value.items.length !== getCurrentQueue.value.count
    })

    const getQueueTracks = async () => {
        const offset = getCurrentQueue.value ? getCurrentQueue.value.items.length : 0

        if (offset === count.value) return []

        if (type.value === "release") {
            return await getReleaseTracks(offset)
        } else if (type.value === "favorite-tracks") {
            await getFavoriteTracks(offset)
        }
    }

    const getReleaseTracks = async (offset: number) => {
        const res = await api.releases.tracks(id.value, offset)

        return responseHandler(res)
    }

    const getFavoriteTracks = async (offset: number) => {
        const res = await api.collection.getFavoriteTracks(offset)

        return responseHandler(res)
    }

    const responseHandler = (res: TrackListResponse) => {
        const data = res.data.data

        const tracks = data.tracks
        const artists = tracks.map(track => track.artists).flat(1)
        const releases = tracks.map(track => track.releases).flat(1)

        if (getCurrentQueue.value === undefined) {
            queueStore.createQueue({
                id: getCurrentQueueId.value,
                items: tracks.map(track => track.id),
                count: data.count,
            })
        }

        trackStore.addItems(tracks)
        artistStore.addItems(artists)
        releaseStore.addItems(releases)

        return tracks
    }

    const setQueueId = (id: string) => {
        queueStore.setQueueId(id)
    }

    const setQueueIdAndPlay = async (id: string) => {
        queueStore.setQueueId(id)

        if (getCurrentQueue.value) {
            await setTrack(getCurrentQueue.value.items[0])
            return
        }

        const tracks = await getQueueTracks()

        await setTrack(tracks[0].id)
    }

    const setPrevTrack = async () => {
        if (currentTime.value >= 5) {
            await setCurrentTime(0)
            await play()
            return
        }

        const newIndex = getCurrentTrackIndex.value - 1

        if (newIndex < 0) {
            const track = getCurrentQueue.value.items[getCurrentQueue.value.count - 1]

            await setTrack(track)
            queueStore.setCurrentTrackIndex(getCurrentQueue.value.count - 1)
            await play()
            return
        }

        await setTrack(getCurrentQueue.value.items[newIndex])
        queueStore.setCurrentTrackIndex(newIndex)
        await play()
    }

    const setNextTrack = async () => {
        const newIndex = getCurrentTrackIndex.value + 1

        if (newIndex > getCurrentQueue.value.count - 1) {
            await setTrack(getCurrentQueue.value.items[0])
            queueStore.setCurrentTrackIndex(0)
            await play()
            return
        }

        await setTrack(getCurrentQueue.value.items[newIndex])
        queueStore.setCurrentTrackIndex(newIndex)
        await play()
    }

    return {
        currentQueueId: getCurrentQueueId,
        getCurrentTrackIndex,

        tracks,
        count,
        hasMore,

        setQueueId,
        setQueueIdAndPlay,
        getQueueTracks,

        setPrevTrack,
        setNextTrack
    }
}
