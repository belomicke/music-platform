<script setup lang="ts">
import { computed } from "vue"
import { ApiTrack } from "@/shared/api"

const props = defineProps<{
    track: ApiTrack
}>()

const duration = computed(() => {
    const duration_s = props.track.duration_ms / 1000

    const minutes = Math.floor(duration_s / 60)
    const seconds = Number(duration_s - minutes * 60).toFixed()

    return `${formatNumberSubTen(minutes)}:${formatNumberSubTen(Number(seconds))}`
})

const formatNumberSubTen = (value: number) => {
    return value < 10 ? `0${value}` : value
}
</script>

<template>
    <div class="track-list-item-duration">
        {{ duration }}
    </div>
</template>

<style scoped lang="scss">
.track-list-item-duration {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text-secondary);
}
</style>
