<script setup lang="ts">
import { IIconButton } from "@/shared/ui"
import { ApiTrack } from "@/shared/api"

const props = defineProps<{
    track: ApiTrack
    isPlaying: boolean
}>()

const emit = defineEmits([
    "pause",
    "play",
])

const clickHandler = async () => {
    if (props.isPlaying) {
        emit("pause")
    } else {
        emit("play")
    }
}
</script>

<template>
    <i-icon-button
        class="track-list-item-play-button"
        :icon="isPlaying ? 'pause' : 'play'"
        :size="24"
        :icon-size="24"
        filled
        @click="clickHandler"
    />
</template>

<style scoped lang="scss">
.track-list-item-play-button {
    color: rgb(255, 255, 255);
    opacity: 0;
    transition: color .15s;

    .track-list-item:hover & {
        opacity: 1;

        &:hover {
            color: #e6e6e6;
        }
    }
}
</style>
