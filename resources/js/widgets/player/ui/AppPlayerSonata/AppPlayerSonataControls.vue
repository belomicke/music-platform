<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IIconButton } from "@/shared/ui"

const { play, pause, setPrevTrack, setNextTrack } = useBackendPlayerStore()
const {
    getIsPlaying: isPlaying,
    canSetPrevTrack,
    canSetNextTrack,
} = storeToRefs(useBackendPlayerStore())

const playButtonHandler = () => {
    if (isPlaying.value) {
        pause()
    } else {
        play()
    }
}
</script>

<template>
    <div class="app-player-sonata-controls">
        <i-icon-button
            icon="previous"
            variant="transparent"
            :icon-size="20"
            @click="setPrevTrack"
            :disabled="canSetPrevTrack === false"
        />
        <i-icon-button
            @click="playButtonHandler"
            :icon="isPlaying ? 'pause' : 'play'"
            class="app-player-sonata-controls__play-button"
            variant="transparent"
            :icon-size="40"
            filled
        />
        <i-icon-button
            icon="next"
            variant="transparent"
            :icon-size="20"
            @click="setNextTrack"
            :disabled="canSetNextTrack === false"
        />
    </div>
</template>

<style scoped lang="scss">
.app-player-sonata-controls {
    display: flex;
    align-items: center;
    gap: 4px;

    &__play-button {
        color: rgb(255, 255, 255);
    }
}
</style>
