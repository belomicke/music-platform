<script setup lang="ts">
import { onMounted, onUnmounted } from "vue"
import { storeToRefs } from "pinia"
import { AppPlayerSonata } from "./AppPlayerSonata"
import AppPlayerInfo from "./AppPlayerInfo.vue"
import AppPlayerMeta from "./AppPlayerMeta.vue"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { useNextTrack } from "@/features/player/set-next-track"
import { api } from "@/shared/api"

const backendPlayerStore = useBackendPlayerStore()
const {
    getPlayer: player,
    getTrack: track,
    getRepeatState: repeatState,
} = storeToRefs(backendPlayerStore)

const { mutate: setNextTrack } = useNextTrack()

onMounted(async () => {
    await getPlayerState()

    player.value.addEventListener("ended", onEndHandler)
    player.value.addEventListener("play", onPlayHandler)
    player.value.addEventListener("pause", onPauseHandler)
    player.value.addEventListener("timeupdate", updateCurrentTime)

    backendPlayerStore.setPlayerTime(Number(localStorage.getItem("player-current-time")))
})

onUnmounted(() => {
    player.value.removeEventListener("ended", onEndHandler)
    player.value.removeEventListener("play", onPlayHandler)
    player.value.removeEventListener("pause", onPauseHandler)
    player.value.removeEventListener("timeupdate", updateCurrentTime)
})

async function getPlayerState() {
    const res = await api.player.init()
    const data = res.data.data

    backendPlayerStore.setState(data)
}

function updateCurrentTime() {
    const value = Math.floor(this.currentTime)

    backendPlayerStore.setCurrentTime(value)
}

function onPlayHandler() {
    backendPlayerStore.setIsPlaying(true)
}

function onPauseHandler() {
    backendPlayerStore.setIsPlaying(false)
}

const onEndHandler = async () => {
    if (repeatState.value === "track") {
        backendPlayerStore.setPlayerTime(0)
        await backendPlayerStore.play()
    } else if (repeatState.value === "context") {
        await setNextTrack()
        await backendPlayerStore.play()
    }
}
</script>

<template>
    <div
        class="app-player"
        v-if="track"
    >
        <app-player-info
            :track="track"
        />
        <app-player-sonata/>
        <app-player-meta/>
    </div>
</template>

<style lang="scss">
.app-player {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-between;
    align-items: center;
    padding: 0 8px;
    height: 100%;
    background-color: var(--ym-background-color-primary-enabled-content);
    border: 0.0625rem solid var(--ym-outline-color-primary-disabled);
    border-radius: 12px;
}
</style>
