<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useAuthStore } from "../model"
import { IAvatar, UiSize } from "@/shared/ui"

withDefaults(defineProps<{
    size?: string
    iconSize?: UiSize
    withOverlay?: boolean
    withModal?: boolean
}>(), {
    size: "100%",
    iconSize: "m",
    withOverlay: false,
    withModal: false,
})

const authStore = useAuthStore()
const { getCurrentUser: user } = storeToRefs(authStore)
</script>

<template>
    <i-avatar
        :url="user.image_url"
        :size="size"
        icon="user"
        :icon-size="iconSize"
        round

        :with-overlay="withOverlay"
        :with-modal="withModal"
    />
</template>

<style lang="scss">

</style>
