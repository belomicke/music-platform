<script setup lang="ts">
import TrackListItemPlayButton from "./TrackListItemPlayButton.vue"
import TrackListItemPulse from "./TrackListItemPulse.vue"
import { ApiTrack } from "@/shared/api"

defineProps<{
    track: ApiTrack
    number: number
    isActive: boolean
    isPlaying: boolean
}>()

const emit = defineEmits([
    "pause",
    "play",
])

const playHandler = () => {
    emit("play")
}

const pauseHandler = () => {
    emit("pause")
}
</script>

<template>
    <div
        class="track-list-item-index"
        :class="[
            isPlaying && 'is-playing',
            isActive && 'is-active'
        ]"
    >
        <track-list-item-pulse
            v-if="isPlaying"
        />
        <div
            class="track-list-item-index__number"
            v-else-if="!isPlaying && !isActive"
        >
            {{ number }}
        </div>
        <track-list-item-play-button
            class="track-list-item-index__play-button"
            :track="track"
            :is-playing="isPlaying"
            @play="playHandler"
            @pause="pauseHandler"
        />
    </div>
</template>

<style scoped lang="scss">
.track-list-item-index {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    width: 28px;
    height: 28px;

    &__number {
        font-size: 14px;
        font-weight: 500;
        color: var(--color-text-secondary);
        pointer-events: none;
        transition: opacity .3s;

        .track-list-item:hover & {
            opacity: 0;
        }
    }

    &__play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        .track-list-item-index.is-active:not(.is-playing) & {
            opacity: 1;
        }
    }
}
</style>
