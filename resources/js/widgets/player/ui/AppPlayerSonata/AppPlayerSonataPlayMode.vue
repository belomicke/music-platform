<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IIconButton } from "@/shared/ui"

const backendPlayerStore = useBackendPlayerStore()
const { getPlayMode: playMode } = storeToRefs(backendPlayerStore)

const changePlayMode = () => {
    if (playMode.value === "repeat-off") {
        backendPlayerStore.setPlayMode("repeat")
    } else if (playMode.value === "repeat") {
        backendPlayerStore.setPlayMode("repeat-one")
    } else {
        backendPlayerStore.setPlayMode("repeat-off")
    }
}
</script>

<template>
    <i-icon-button
        class="app-player-sonata-play-mode"
        :icon="playMode === 'repeat-one' ? 'repeat-one' : 'repeat'"
        :class="[
            playMode !== 'repeat-off' && 'active'
        ]"
        variant="transparent"
        :icon-size="24"
        @click="changePlayMode"
    />
</template>

<style scoped lang="scss">
.app-player-sonata-play-mode {
    color: var(--color-text-secondary);

    &:hover {
        color: var(--color-text-secondary) !important;
    }

    &.active {
        color: white;

        &:hover {
            color: white !important;
        }
    }
}
</style>
