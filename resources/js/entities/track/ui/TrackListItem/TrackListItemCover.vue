<script setup lang="ts">
import TrackListItemPlayButton from "./TrackListItemPlayButton.vue"
import TrackListItemPulse from "./TrackListItemPulse.vue"
import type { ApiTrack } from "@/shared/api"
import { IAvatar } from "@/shared/ui"

defineProps<{
    track: ApiTrack | undefined
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
        class="track-list-item-cover__container"
        :class="[
            isPlaying && 'is-playing',
            isActive && 'is-active'
        ]"
    >
        <track-list-item-pulse
            class="track-list-item-cover__is-playing"
            v-if="isPlaying"
        />
        <i-avatar
            class="track-list-item-cover"
            :url="track.releases[0].image_url"
            size="40px"
        />
        <track-list-item-play-button
            class="track-list-item-cover__play-button"
            :track="track"
            :is-playing="isPlaying"
            @play="playHandler"
            @pause="pauseHandler"
        />
    </div>
</template>

<style lang="scss">
.track-list-item-cover {
    width: 40px;

    &__container {
        position: relative;

        &::after {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            border-radius: 6px;
            background-color: rgba(255, 255, 255, .1);
            opacity: 0;
        }

        &.is-active::after,
        &.is-playing::after,
        .track-list-item:hover &::after {
            opacity: 1;
        }
    }

    &__play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;

        .track-list-item-cover__container.is-active:not(.is-playing) & {
            opacity: 1;
        }
    }

    &__is-playing {
        z-index: 1;
    }
}
</style>
