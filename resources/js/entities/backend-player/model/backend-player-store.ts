import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { useTrackStore } from "@/entities/track"
import { PlayerState, RepeatState } from "@/shared/api/types"
import { api, ApiTrack } from "@/shared/api"

export const useBackendPlayerStore = defineStore("backend-player", () => {
    const player = ref<HTMLAudioElement>(new Audio())

    const track = ref<ApiTrack | undefined>(undefined)
    const contextId = ref<string>("")

    const isPlaying = ref<boolean>(false)
    const currentTime = ref<number>(0)
    const volume = ref<number>(Number(localStorage.getItem("player-volume")) ?? 50)
    const repeatState = ref<RepeatState>(localStorage.getItem("repeat-state") as RepeatState ?? "off")
    const position = ref<number>(0)
    const length = ref<number>(0)

    const getPlayer = computed(() => player.value)

    const getTrack = computed(() => track.value)
    const getContextId = computed(() => contextId.value)

    const getIsPlaying = computed(() => isPlaying.value)
    const getDuration = computed(() => Math.floor(track.value.duration_ms / 1000))
    const getCurrentTime = computed(() => currentTime.value)
    const getVolume = computed(() => volume.value)
    const getRepeatState = computed(() => repeatState.value)

    const canSetNextTrack = computed(() => {
        if (contextId.value === undefined) return false
        if (length.value === 1) return false
        if (repeatState.value === "context") return true

        return position.value < length.value
    })

    const canSetPrevTrack = computed(() => {
        if (contextId.value === undefined) return false
        if (length.value > 1 && repeatState.value === "context") return true
        if (currentTime.value >= 5) return true

        return position.value > 0
    })

    const setState = (value: PlayerState) => {
        track.value = value.track
        position.value = value.position
        length.value = value.length
        contextId.value = value.context_id
        setRepeatState(value.repeat_state)
        setVolume(value.volume)

        if (value.track) {
            const trackStore = useTrackStore()
            const artistStore = useArtistStore()
            const releaseStore = useReleaseStore()

            trackStore.addItem(value.track)
            releaseStore.addItem(value.track.release)
            artistStore.addItems(value.track.artists)

            player.value.src = `/api/player?s=${new Date().getTime()}`
        }
    }

    const setIsPlaying = (value: boolean) => {
        isPlaying.value = value
    }

    const play = async () => {
        await player.value.play()
    }

    const pause = () => {
        player.value.pause()
    }

    const setCurrentTime = (value: number) => {
        if (value > track.value.duration_ms) {
            currentTime.value = track.value.duration_ms
            localStorage.setItem("player-current-time", String(value))
            return
        }

        currentTime.value = value
        localStorage.setItem("player-current-time", String(value))
    }

    const setPlayerTime = (value: number) => {
        player.value.currentTime = value
        setCurrentTime(value)
    }

    const setVolume = (value: number) => {
        player.value.volume = value / 100
        volume.value = value
        localStorage.setItem("player-volume", String(value))
    }

    const setRepeatState = (value: RepeatState) => {
        repeatState.value = value
        localStorage.setItem("repeat-state", value)
    }

    const setPosition = (value: number) => {
        position.value = value
    }

    const setTrack = async (context_id: string, position: number) => {
        const res = await api.player.setTrack(context_id, position)

        if (res.data.success) {
            track.value = res.data.data.track
            length.value = res.data.data.length
            contextId.value = context_id
            setPosition(position)
            player.value.src = `/api/player?s=${new Date().getTime()}`
        }
    }

    return {
        getPlayer,

        getTrack,
        getContextId,

        getIsPlaying,
        getCurrentTime,
        getDuration,
        getVolume,
        getRepeatState,

        canSetNextTrack,
        canSetPrevTrack,

        setState,
        setTrack,
        setIsPlaying,

        setVolume,
        setRepeatState,

        play,
        pause,
        setCurrentTime,
        setPlayerTime,
    }
})
