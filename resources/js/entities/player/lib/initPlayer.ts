import { PlayMode, usePlayerStore } from "@/entities/player"

export const initPlayer = () => {
    const playerStore = usePlayerStore()

    const volumeFromLS = Number(localStorage.getItem("player-volume"))

    if (volumeFromLS !== null) {
        playerStore.setVolume(volumeFromLS)
    }

    const trackFromLS = localStorage.getItem("current-track-id")

    if (trackFromLS !== null) {
        playerStore.setCurrentTrackId(trackFromLS)
    }

    const currentTimeFromLS = Number(localStorage.getItem("player-current-time"))

    if (currentTimeFromLS !== null) {
        playerStore.setPlayerTime(currentTimeFromLS)
    }

    const playModeFromLS = localStorage.getItem("play-mode")

    if (playModeFromLS !== null) {
        playerStore.setPlayMode(playModeFromLS as PlayMode)
    }
}
