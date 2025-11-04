<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import type { ApiRelease } from "@/shared/api"
import { IButton } from "@/shared/ui"

const props = withDefaults(defineProps<{
    release: ApiRelease,
    compact?: boolean,
}>(), {
    variant: "secondary",
    compact: false,
})

const backendPlayerStore = useBackendPlayerStore()
const {
    getIsPlaying: playerIsPlaying,
    getContextId: playerContextId,
} = storeToRefs(backendPlayerStore)

const contextId = computed(() => {
    return `release:${props.release.id}`
})

const isActive = computed(() => {
    return playerContextId.value === contextId.value
})

const isPlaying = computed(() => {
    return isActive.value && playerIsPlaying.value
})

const clickHandler = async () => {
    if (isActive.value === false) {
        await backendPlayerStore.setTrack(contextId.value, 1)
        await backendPlayerStore.play()
        return
    }

    if (isPlaying.value) {
        backendPlayerStore.pause()
    } else {
        await backendPlayerStore.play()
    }
}
</script>

<template>
    <i-button
        :icon="isPlaying ? 'pause' : 'play'"
        class="release-play-button-compact"
        variant="secondary"
        icon-size="xl"
        icon-button
        icon-filled
        no-padding
        round
        @click="clickHandler"
        v-if="compact"
    />

    <i-button
        variant="primary"
        :icon="isPlaying ? 'pause' : 'play'"
        round

        @click="clickHandler"

        v-else
    >
        Слушать
    </i-button>
</template>

<style lang="scss">
.release-play-button-compact {
    transform: scale(1);

    &:hover {
        transform: scale(1.05);
    }
}

.release-play-button {
    display: flex;
    align-items: center;
    border-radius: 999px;
    border: none;
    outline: none;
    gap: 4px;
    height: 100%;

    cursor: pointer;

    &.primary {
        font-size: 14px;
        font-weight: 500;
        padding: 0 16px;
        color: rgb(0, 0, 0);
        background-color: var(--color-primary);

        &:hover {
            background-color: var(--color-primary-hover);
        }
    }

    &.secondary {
        color: rgb(255, 255, 255);
        transition: color .15s;

        &:hover {
            color: rgb(220, 220, 220);
        }
    }
}
</style>
