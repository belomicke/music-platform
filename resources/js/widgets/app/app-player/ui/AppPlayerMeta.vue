<script setup lang="ts">
import { usePlayerVolume } from "@/features/player/player-volume"
import { IIconButton, IInputRange } from "@/shared/ui"

const {
    data: volume,
    setVolume,
    mute,
} = usePlayerVolume()
</script>

<template>
    <div class="app-player-meta">
        <i-icon-button
            :icon="volume === 0 ? 'volume-off' : 'volume'"
            size="s"
            variant="transparent"
            @click="mute"
        />
        <i-input-range
            class="app-player-meta__volume"
            v-model="volume"
            :min="0"
            :max="100"
            :step="1"
            @input="setVolume"
        />
    </div>
</template>

<style scoped lang="scss">
.app-player-meta {
    display: flex;
    justify-self: flex-end;
    align-items: center;
    gap: 8px;
    padding-right: 24px;

    &__volume {
        width: 60px;
    }
}
</style>
