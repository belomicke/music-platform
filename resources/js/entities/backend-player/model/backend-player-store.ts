import { computed, getCurrentInstance, onMounted, ref } from "vue"
import { defineStore } from "pinia"
import { playerMethods } from "../api/player"
import { useTrackStore } from "@/entities/track"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { ApiTrack } from "@/shared/api"

export type PlayMode = "repeat-off" | "repeat" | "repeat-one"

export const useBackendPlayerStore = defineStore("backend-player", () => {
    const player = ref<HTMLAudioElement>(new Audio())

    const track = ref<ApiTrack | undefined>(undefined)
    const trackId = ref<string>("")
    const contextId = ref<string>("")

    const isPlaying = ref<boolean>(false)
    const currentTime = ref<number>(0)
    const volume = ref<number>(0.5)
    const playMode = ref<PlayMode>("repeat-off")
    const position = ref<number>(0)
    const length = ref<number>(0)

    const getTrack = computed(() => track.value)
    const getTrackId = computed(() => trackId.value)
    const getContextId = computed(() => contextId.value)

    const getIsPlaying = computed(() => isPlaying.value)
    const getCurrentTime = computed(() => currentTime.value)
    const getVolume = computed(() => volume.value)
    const getPlayMode = computed(() => playMode.value)
    const getPosition = computed(() => position.value)
    const getLength = computed(() => length.value)

    const canSetNextTrack = computed(() => {
        if (trackId.value === undefined) return false
        if (contextId.value === undefined) return false
        if (length.value === 1) return false
        if (playMode.value === "repeat") return true

        return position.value < length.value
    })

    const canSetPrevTrack = computed(() => {
        if (trackId.value === undefined) return false
        if (contextId.value === undefined) return false
        if (length.value > 1 && playMode.value === "repeat") return true
        if (currentTime.value >= 5) return true

        return position.value > 0
    })

    if (getCurrentInstance()) {
        onMounted(async () => {
            const res = await playerMethods.init()
            const data = res.data.data

            track.value = data.track
            trackId.value = data.track_id
            contextId.value = data.context_id
            position.value = data.position
            length.value = data.length

            if (data.track) {
                handleTrackFromResponse(data.track)
                player.value.src = `/api/player?s=${new Date().getTime()}`
            }

            player.value.addEventListener("play", onPlayHandler)
            player.value.addEventListener("pause", onPauseHandler)
            player.value.addEventListener("timeupdate", updateCurrentTime)
            player.value.addEventListener("ended", onEndHandler)

            setPlayerTime(Number(localStorage.getItem("player-current-time")))

            if (localStorage.getItem("player-volume")) {
                setVolume(Number(localStorage.getItem("player-volume")))
            } else {
                player.value.volume = 0.1
            }

            setPlayMode(localStorage.getItem("play-mode") as PlayMode)
        })

        function handleTrackFromResponse(track: ApiTrack) {
            const trackStore = useTrackStore()
            const artistStore = useArtistStore()
            const releaseStore = useReleaseStore()

            trackStore.addItem(track)
            artistStore.addItems(track.artists)
            releaseStore.addItems(track.releases)
        }

        function updateCurrentTime() {
            const value = Number(this.currentTime.toFixed())
            currentTime.value = value
            localStorage.setItem("player-current-time", String(value))
        }

        function onPlayHandler() {
            isPlaying.value = true
        }

        function onPauseHandler() {
            isPlaying.value = false
        }

        async function onEndHandler() {
            if (playMode.value === "repeat-one") {
                setPlayerTime(0)
                await play()
            } else if (playMode.value === "repeat") {
                await setNextTrack()
                await play()
            }
        }
    }

    const play = async () => {
        await player.value.play()
    }

    const pause = () => {
        player.value.pause()
    }

    const setCurrentTime = (value: number) => {
        currentTime.value = value
    }

    const setPlayerTime = (value: number) => {
        player.value.currentTime = value
        setCurrentTime(value)
    }

    const setVolume = (value: number) => {
        const fixedValue = Number(value.toFixed(2))

        player.value.volume = fixedValue
        volume.value = fixedValue
        localStorage.setItem("player-volume", String(fixedValue))
    }

    const setPlayMode = (value: PlayMode) => {
        playMode.value = value
        localStorage.setItem("play-mode", value)
    }

    const setPosition = (value: number) => {
        position.value = value
    }

    const setTrack = async (context_id: string, position: number) => {
        const res = await playerMethods.setTrack(context_id, position)

        if (res.data.success) {
            const trackStore = useTrackStore()
            trackStore.addItem(res.data.data.track)

            track.value = res.data.data.track
            trackId.value = res.data.data.track.id
            length.value = res.data.data.length
            contextId.value = context_id
            setPosition(position)
            player.value.src = `/api/player?s=${new Date().getTime()}`
        }
    }

    const setPrevTrack = async () => {
        if (currentTime.value > 5) {
            setPlayerTime(0)
            return
        }

        if (position.value - 1 === 0) {
            await setTrack(contextId.value, length.value)
            await play()
            return
        }

        await setTrack(contextId.value, position.value - 1)
        await play()
    }

    const setNextTrack = async () => {
        if (position.value + 1 > length.value) {
            await setTrack(contextId.value, 1)
            await play()
            return
        }

        await setTrack(contextId.value, position.value + 1)
        await play()
    }

    return {
        getTrack,
        getTrackId,
        getContextId,

        getIsPlaying,
        getCurrentTime,
        getVolume,
        getPlayMode,
        getPosition,
        getLength,

        canSetNextTrack,
        canSetPrevTrack,

        play,
        pause,
        setCurrentTime,
        setPlayerTime,
        setVolume,
        setPlayMode,

        setTrack,
        setPrevTrack,
        setNextTrack,
    }
})
