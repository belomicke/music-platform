<script setup lang="ts">
import { IAvatar, UiSize } from "@/shared/ui"

withDefaults(defineProps<{
    url: string
    size?: string
    iconSize?: UiSize
    clickable?: boolean
    withOverlay?: boolean
    withModal?: boolean
}>(), {
    size: "100%",
    iconSize: "xxl",
    clickable: false,
    withOverlay: false,
    withModal: false,
})
</script>

<template>
    <i-avatar
        :url="url"
        icon="release"
        :icon-size="iconSize"
        :size="size"
        :clickable="clickable"
        :with-overlay="withOverlay"
        :with-modal="withModal"
    >
        <template #overlay-top-left>
            <slot name="overlay-top-left"></slot>
        </template>
        <template #overlay-top-right>
            <slot name="overlay-top-right"></slot>
        </template>
        <template #overlay-bottom-left>
            <slot name="overlay-bottom-left"></slot>
        </template>
        <template #overlay-bottom-right>
            <slot name="overlay-bottom-right"></slot>
        </template>
    </i-avatar>
</template>

<style lang="scss">

</style>
