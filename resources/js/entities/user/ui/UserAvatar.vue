<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useCompactUserStore } from "@/entities/user"
import { IAvatar } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    size?: number
    clickable?: boolean
    canBeOpenInModal?: boolean
}>(), {
    size: 36,
    clickable: false,
    canBeOpenInModal: false,
})

const compactUserStore = useCompactUserStore()
const { getById } = storeToRefs(compactUserStore)

const user = computed(() => getById.value(props.id))
</script>

<template>
    <i-avatar
        :url="user.image_url"
        :size="size"
        :clickable="clickable"
        :can-be-open-in-modal="canBeOpenInModal"
        icon="user"
    />
</template>

<style lang="scss">

</style>
