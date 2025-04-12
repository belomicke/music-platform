<script setup lang="ts">
import { IAvatar, IIcon } from "@/shared/ui"

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
    >
        <i-icon
            icon="user"
            class="user-avatar__icon"
            color="rgb(128, 128, 128)"
        />
    </i-avatar>
</template>

<style lang="scss">
.user-avatar__icon {
    width: 60%;
    height: 60%;
}
</style>
