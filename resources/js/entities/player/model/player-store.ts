import { computed, getCurrentInstance, onMounted, onUnmounted, ref } from "vue"
import { defineStore } from "pinia"
import { useQueue } from "@/entities/player"

export type PlayMode = "repeat-off" | "repeat" | "repeat-one"

export const usePlayerStore = defineStore("player", () => {
    const player = ref<HTMLAudioElement>(new Audio())
    const currentTrackId = ref<string>("")
    const isPlaying = ref<boolean>(false)
    const playMode = ref<PlayMode>("repeat-off")
    const currentTime = ref<number>(0)
    const volume = ref<number>(0.5)

    const getPlayer = computed(() => player.value)
    const getCurrentTrackId = computed(() => currentTrackId.value)
    const getIsPlaying = computed(() => isPlaying.value)
    const getPlayMode = computed(() => playMode.value)
    const getCurrentTime = computed(() => currentTime.value)
    const getVolume = computed(() => volume.value)

    const { setNextTrack } = useQueue()

    if (getCurrentInstance()) {
        onMounted(async () => {
            // initPlayer()

            player.value.addEventListener("timeupdate", timeUpdateHandler)
            player.value.addEventListener("pause", onPauseHandler)
            player.value.addEventListener("play", onPlayHandler)
            player.value.addEventListener("ended", onEndHandler)
        })

        onUnmounted(() => {
            player.value.removeEventListener("timeupdate", timeUpdateHandler)
            player.value.removeEventListener("pause", onPauseHandler)
            player.value.removeEventListener("play", onPlayHandler)
            player.value.removeEventListener("ended", onEndHandler)
        })

        function timeUpdateHandler() {
            const value = Number(this.currentTime.toFixed())
            setCurrentTime(value)
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

    const setCurrentTrackId = (id: string) => {
        currentTrackId.value = id
        player.value.src = `/api/tracks/${id}`
        setPlayerTime(0)
        player.value.load()
        localStorage.setItem("current-track-id", id)
    }

    const setSrc = (src: string) => {
        player.value.src = src
        player.value.load()
    }

    const play = async () => {
        await player.value.play()
    }

    const playAsPossible = () => {
        player.value.addEventListener("canplay", play)
    }

    const pause = () => {
        player.value.pause()
    }

    const setPlayerTime = (value: number) => {
        player.value.currentTime = value
        currentTime.value = value
    }

    const setVolume = (value: number) => {
        const fixedValue = Number(value.toFixed(2))

        player.value.volume = fixedValue
        volume.value = fixedValue
        localStorage.setItem("player-volume", String(fixedValue))
    }

    const setIsPlaying = (value: boolean) => {
        isPlaying.value = value
    }

    const setPlayMode = (value: PlayMode) => {
        playMode.value = value
        localStorage.setItem("play-mode", value)
    }

    const setCurrentTime = (value: number) => {
        currentTime.value = value
    }

    return {
        getPlayer,
        getCurrentTrackId,
        getIsPlaying,
        getPlayMode,
        getCurrentTime,
        getVolume,

        setCurrentTrackId,
        setSrc,

        play,
        playAsPossible,
        pause,

        setPlayerTime,
        setVolume,
        setIsPlaying,
        setPlayMode,
        setCurrentTime,
    }
})
