<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useAuthStore } from "../model"
import { IAvatar } from "@/shared/ui"

withDefaults(defineProps<{
    size?: string
    clickable?: boolean
    canBeOpenInModal?: boolean
}>(), {
    size: "36px",
    clickable: false,
    canBeOpenInModal: false,
})

const authStore = useAuthStore()
const { getCurrentUser: user } = storeToRefs(authStore)
</script>

<template>
    <i-avatar
        :url="user.image_url"
        :size="size"
        :clickable="clickable"
        :can-be-open-in-modal="canBeOpenInModal"
        round
        icon="user"
    />
</template>

<style lang="scss">

</style>
