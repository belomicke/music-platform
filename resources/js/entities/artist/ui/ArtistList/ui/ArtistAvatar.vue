<script setup lang="ts">
import { IAvatar } from "@/shared/ui"

withDefaults(defineProps<{
    size?: number
    clickable?: boolean
}>(), {
    size: 36,
    clickable: false,
})
</script>

<template>
    <i-avatar
        :size="size"
        :clickable="clickable"
        icon="music"
    />
</template>

<style lang="scss">

</style>
