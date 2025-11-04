<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import TrackPulse from "./TrackPulse.vue"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { ReleaseCover } from "@/entities/release"
import { useTrackStore } from "@/entities/track"
import { IIconButton } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    contextId: string
    index: number
    withCover: boolean
}>(), {
    withCover: false,
    isActive: false,
})

const emit = defineEmits([
    "pause",
    "play",
])

const trackStore = useTrackStore()
const { getTrackById } = storeToRefs(trackStore)
const track = computed(() => getTrackById.value(props.id))

const backendPlayerStore = useBackendPlayerStore()
const {
    getTrack: playerTrack,
    getIsPlaying: playerIsPlaying,
} = storeToRefs(backendPlayerStore)

const isActive = computed(() => {
    if (!playerTrack.value) return false

    return playerTrack.value.id === track.value.id
})

const isPlaying = computed(() => {
    return isActive.value && playerIsPlaying.value
})

const playHandler = async () => {
    if (!playerTrack.value) {
        await backendPlayerStore.setTrack(props.contextId, props.index)
    } else if (playerTrack.value.id !== track.value.id) {
        await backendPlayerStore.setTrack(props.contextId, props.index)
    }

    await backendPlayerStore.play()
}

const pauseHandler = () => {
    backendPlayerStore.pause()
}

const clickHandler = () => {
    if (isPlaying.value) {
        pauseHandler()
    } else {
        playHandler()
    }
}
</script>

<template>
    <div
        class="track-play-button"
        :class="[
            isPlaying && 'is-playing',
            isActive && 'is-active'
        ]"
    >
        <div
            class="track-play-button__container"
            :class="[
                withCover && 'with-cover'
            ]"
        >
            <track-pulse
                class="track-play-button__pulse"
                v-if="isPlaying"
            />

            <release-cover
                class="track-play-button__image"
                :url="track.release.image_url"
                icon-size="xs"
                :alt="`Трек ${track.title}`"
                v-if="withCover"
            />

            <div
                class="track-play-button__index"
                v-else-if="!withCover && (!isPlaying && !isActive)"
            >
                {{ index }}
            </div>

            <i-icon-button
                class="track-play-button__button"
                :icon="isPlaying ? 'pause' : 'play'"

                :active="withCover ? isActive : false"
                :size="withCover ? 'xs' : undefined"
                filled

                @click="clickHandler"
            />
        </div>
    </div>
</template>

<style lang="scss">
.track-play-button {
    --background-z-index: 1;
    --control-z-index: 2;
    --cover-fallback-size: 2.5rem;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    aspect-ratio: 1;
    position: relative;
    max-width: var(--cover-size, var(--cover-fallback-size));
    min-width: var(--cover-size, var(--cover-fallback-size));
    width: 100%;

    &__container {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: var(--ym-radius-size-xs);
        position: relative;
        overflow: hidden;
        outline: none;
        width: 100%;
        height: 100%;

        &.with-cover::before {
            content: "";
            background-color: var(--ym-surface-color-primary-enabled-entity);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            pointer-events: none;
            z-index: var(--background-z-index);
            transition: opacity var(--ym-duration-transition);

            .track-play-button.is-active &,
            .track-play-button.is-playing &,
            .track-list-item:hover & {
                opacity: 1;
            }
        }
    }

    &__image {
        object-fit: cover;
        width: 100%;
        filter: grayscale(0);
        transition: filter var(--ym-duration-transition);
    }

    &__index {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: var(--ym-font-size-label-m);
        font-weight: var(--ym-font-weight-normal);
        line-height: var(--ym-font-line-height-label-m);
        width: 1.75rem;
        height: 1.75rem;
        color: var(--color-text-secondary);
        pointer-events: none;
        transition: opacity .3s;

        .track-list-item:hover & {
            opacity: 0;
        }
    }

    &__button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        z-index: 1;
        transition: opacity var(--ym-duration-transition);

        .track-list-item:hover &,
        .track-play-button.is-active:not(.is-playing) & {
            opacity: 1;
        }
    }

    &__pulse {
        z-index: 1;
    }
}
</style>
