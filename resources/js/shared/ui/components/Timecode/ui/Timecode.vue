<script setup lang="ts">
import { computed } from "vue"

const props = defineProps<{
    seconds: number
}>()

const timecode = computed(() => {
    const minutes = Math.floor(props.seconds / 60)
    const seconds = Number(props.seconds - minutes * 60).toFixed()

    return `${formatNumberSubTen(minutes)}:${formatNumberSubTen(Number(seconds))}`
})

const formatNumberSubTen = (value: number) => {
    return value < 10 ? `0${value}` : value
}
</script>

<template>
    <div class="i-timecode">
        {{ timecode }}
    </div>
</template>

<style lang="scss">
.i-timecode {
    color: var(--text-enabled-color);
    font-size: var(--ym-font-size-label-m);
    font-weight: var(--ym-font-weight-medium);
    line-height: var(--ym-font-line-height-label-m);
}
</style>
