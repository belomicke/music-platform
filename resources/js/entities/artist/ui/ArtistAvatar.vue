<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useCompactArtistStore } from "@/entities/artist"
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

const compactArtistStore = useCompactArtistStore()
const { getById: getCompactArtistById } = storeToRefs(compactArtistStore)

const artist = computed(() => getCompactArtistById.value(props.id))
</script>

<template>
    <i-avatar
        :url="artist.image_url"
        :size="size"
        :can-be-open-in-modal="canBeOpenInModal"
        :clickable="clickable"
        icon="music"
    />
</template>

<style lang="scss">

</style>
