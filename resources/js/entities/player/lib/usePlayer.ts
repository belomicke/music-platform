import { computed } from "vue"
import { storeToRefs } from "pinia"
import { usePlayerStore, useQueueStore } from "../model"
import { useTrackStore } from "@/entities/track"

type PlayMode = "repeat-off" | "repeat" | "repeat-one"

export const usePlayer = () => {
    const playerStore = usePlayerStore()
    const {
        getCurrentTrackId,
        getIsPlaying,
        getPlayMode,
        getCurrentTime,
        getVolume,
    } = storeToRefs(playerStore)

    const trackStore = useTrackStore()
    const { getById: getTrackById } = storeToRefs(trackStore)

    const currentTrackId = computed(() => getCurrentTrackId.value)
    const isPlaying = computed(() => getIsPlaying.value)
    const playMode = computed(() => getPlayMode.value)
    const currentTime = computed(() => getCurrentTime.value)
    const volume = computed(() => getVolume.value)

    const queueStore = useQueueStore()
    const { getCurrentQueue } = storeToRefs(queueStore)

    const canSetPrevTrack = computed(() => {
        if (currentTrackId.value === undefined) return false
        if (getCurrentQueue.value === undefined) return false
        if (getCurrentQueue.value.count > 1 && playMode.value === "repeat") return true
        if (currentTime.value >= 5) return true

        return getCurrentQueue.value.items.indexOf(currentTrackId.value) !== 0
    })

    const canSetNextTrack = computed(() => {
        if (getCurrentQueue.value === undefined) return false
        if (getCurrentQueue.value.count === 1) return false
        if (playMode.value === "repeat") return true

        return getCurrentQueue.value.items.at(-1) !== currentTrackId.value
    })

    const track = computed(() => {
        return getTrackById.value(currentTrackId.value)
    })

    const setCurrentTime = async (value: number) => {
        playerStore.setPlayerTime(value)
    }

    const setVolume = (value: number) => {
        playerStore.setVolume(value)
    }

    const setPlayMode = (value: PlayMode) => {
        playerStore.setPlayMode(value)
    }

    const play = async () => {
        await playerStore.play()
    }

    const playAsPossible = () => {
        playerStore.playAsPossible()
    }

    const pause = () => {
        playerStore.pause()
    }

    const setTrack = async (id: string) => {
        playerStore.setCurrentTrackId(id)
    }

    return {
        track,
        currentTime,
        isPlaying,
        volume,
        playMode,
        canSetNextTrack,
        canSetPrevTrack,

        setCurrentTime,
        setVolume,
        setPlayMode,
        play,
        playAsPossible,
        pause,
        setTrack,
    }
}
