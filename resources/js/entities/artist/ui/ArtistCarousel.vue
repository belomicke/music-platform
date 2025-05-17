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

const emit = defineEmits([
    "click-on-title",
    "click-on-item",
])

const items = computed(() => props.artists.map(artist => artist.id))

const clickOnTitleHandler = () => {
    emit("click-on-title")
}

const clickOnItemHandler = (id: string) => {
    emit("click-on-item", id)
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
                @click="clickOnItemHandler(item)"
                :id="item"
            />
        </template>
    </media-carousel>
</template>
