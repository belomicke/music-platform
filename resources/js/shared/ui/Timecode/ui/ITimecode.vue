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

<style scoped lang="scss">
.i-timecode {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text-secondary);
}
</style>
