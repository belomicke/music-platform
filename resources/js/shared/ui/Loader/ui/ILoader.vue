<script setup lang="ts">
import { IIcon } from "@/shared/ui"

withDefaults(defineProps<{
    size?: number
}>(), {
    size: 24,
})
</script>

<template>
    <i-icon
        class="i-loader"
        icon="loader"
        :size="size"
    />
</template>

<style lang="scss">
.i-loader {
    animation: rotate infinite linear 2s;
}

@keyframes rotate {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
