<script setup lang="ts">
import TrackListItemPlayButton from "./TrackListItemPlayButton.vue"

defineProps<{
    number: number
}>()
</script>

<template>
    <div class="track-list-item-number">
        <div
            class="track-list-item-number__number"
            v-if="number !== 0"
        >
            {{ number }}
        </div>
        <track-list-item-play-button/>
    </div>
</template>

<style scoped lang="scss">
.track-list-item-number {
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
}
</style>
