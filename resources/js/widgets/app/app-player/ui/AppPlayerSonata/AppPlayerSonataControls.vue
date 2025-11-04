<script setup lang="ts">
import { storeToRefs } from "pinia"
import { usePreviousTrack } from "@/features/player/set-prev-track"
import { useNextTrack } from "@/features/player/set-next-track"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IIconButton } from "@/shared/ui"

const { play, pause } = useBackendPlayerStore()
const {
    getIsPlaying: isPlaying,
    canSetPrevTrack,
    canSetNextTrack,
} = storeToRefs(useBackendPlayerStore())

const { mutate: setNextTrack } = useNextTrack()
const { mutate: setPreviousTrack } = usePreviousTrack()

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
            size="xs"
            @click="setPreviousTrack"
            :disabled="canSetPrevTrack === false"
        />
        <i-icon-button
            @click="playButtonHandler"
            :icon="isPlaying ? 'pause' : 'play'"
            class="app-player-sonata-controls__play-button"
            variant="transparent"
            size="l"
            filled
        />
        <i-icon-button
            icon="next"
            variant="transparent"
            size="xs"
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
