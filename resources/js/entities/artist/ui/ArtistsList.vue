<script setup lang="ts">
import { computed } from "vue"
import { ArtistMediaCard } from "@/entities/artist"
import { ApiCompactArtist } from "@/shared/api"
import { MediaList } from "@/shared/ui"

const props = defineProps<{
    artists: ApiCompactArtist[]
    hasMore: boolean
}>()

const emit = defineEmits(["load-more", "click-on-title"])

const items = computed(() => props.artists.map(artist => artist.id))

const loadMoreHandler = () => {
    emit("load-more")
}

const clickOnTitleHandler = () => {
    emit("click-on-title")
}
</script>

<template>
    <media-list
        :items="items"
        :has-more="hasMore"
        @click-on-title="clickOnTitleHandler"
        @load-more="loadMoreHandler"
    >
        <template #item="{ item }">
            <artist-media-card
                :id="item"
            />
        </template>
    </media-list>
</template>
