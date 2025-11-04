<script setup lang="ts">
import { usePlayerRepeatState } from "@/features/player/player-repeat-state"
import { IIconButton } from "@/shared/ui"

const {
    data: repeatState,
    mutate: toggleRepeatState,
} = usePlayerRepeatState()
</script>

<template>
    <i-icon-button
        class="app-player-sonata-play-mode"
        :icon="repeatState === 'track' ? 'repeat-one' : 'repeat'"
        :class="[
            repeatState !== 'off' && 'active'
        ]"
        variant="transparent"
        size="s"
        @click="toggleRepeatState"
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
