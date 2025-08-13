<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IIcon, IIconButton } from "@/shared/ui"
import type { ApiRelease } from "@/shared/api"

const props = withDefaults(defineProps<{
    release: ApiRelease,
    variant?: "primary" | "secondary"
}>(), {
    variant: "secondary",
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
    <button
        class="release-play-button primary"
        @click="clickHandler"
        v-if="variant === 'primary'"
    >
        <i-icon
            :icon="isPlaying ? 'pause' : 'play'"
        />
        Слушать
    </button>
    <i-icon-button
        class="release-play-button secondary"
        :icon="isPlaying ? 'pause' : 'play'"
        :size="42"
        :icon-size="42"
        filled
        @click="clickHandler"
        v-if="variant === 'secondary'"
    />
</template>

<style lang="scss">
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
