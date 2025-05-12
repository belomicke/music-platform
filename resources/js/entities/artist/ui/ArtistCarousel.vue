<script setup lang="ts">
import { computed } from "vue"
import ArtistMediaCard from "./ArtistMediaCard.vue"
import { MediaCarousel } from "@/shared/ui"
import type { ApiCompactArtist } from "@/shared/api"

const props = withDefaults(defineProps<{
    artists: ApiCompactArtist[]
    title?: string
    clickableTitle?: boolean
}>(), {
    title: "",
    clickableTitle: false,
})

const emit = defineEmits(["click-on-title"])

const items = computed(() => props.artists.map(artist => artist.id))

const clickOnTitleHandler = () => {
    emit("click-on-title")
}
</script>

<template>
    <media-carousel
        :title="title"
        :items="items"
        :clickable-title="clickableTitle"
        @click-on-title="clickOnTitleHandler"
    >
        <template #item="{ item }">
            <artist-media-card
                :id="item"
            />
        </template>
    </media-carousel>
</template>
