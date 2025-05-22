<script setup lang="ts">
import { IIconButton } from "@/shared/ui"
</script>

<template>
    <i-icon-button
        class="track-list-item-play-button"
        icon="play"
        :size="28"
        :icon-size="28"
    />
</template>

<style scoped lang="scss">
.track-list-item-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    color: rgba(255, 255, 255, .5);
    transform: translate(-50%, -50%);
    opacity: 0;
    z-index: 1;
    transition: color .15s, opacity .3s;

    .track-list-item:hover & {
        opacity: 1;
        
        &:hover {
            color: #e6e6e6;
        }
    }
}
</style>
