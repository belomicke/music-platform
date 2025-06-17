<script setup lang="ts">
import { computed } from "vue"
import ArtistMediaCard from "./ArtistMediaCard.vue"
import { MediaCarousel } from "@/shared/ui"
import type { ApiArtist } from "@/shared/api"

const props = withDefaults(defineProps<{
    artists: ApiArtist[]
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
        :count="items.length"
        :item-width="200"
        :clickable-title="clickableTitle"
        @click-on-title="clickOnTitleHandler"
    >
        <template #item="{ item }">
            <artist-media-card
                class="artist-carousel__item"
                avatar-size="200px"
                @click="clickOnItemHandler(items[item])"
                :id="items[item]"
            />
        </template>
    </media-carousel>
</template>

<style lang="scss">
.artist-carousel__item {
    width: 200px;
}
</style>
