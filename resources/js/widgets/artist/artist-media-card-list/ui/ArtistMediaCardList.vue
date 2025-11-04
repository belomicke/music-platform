<script setup lang="ts">
import { computed } from "vue"
import { ArtistMediaCard } from "../../artist-media-card"
import { ApiArtist } from "@/shared/api"
import { MediaList } from "@/shared/ui"

const props = withDefaults(defineProps<{
    artists: ApiArtist[]
    title?: string
    hasMore?: boolean
    oneRow?: boolean
}>(), {
    title: "",
    hasMore: false,
    oneRow: false,
})

const emit = defineEmits([
    "load-more",
    "click-on-item",
])

const items = computed(() => props.artists.map(artist => artist.id))

const loadMoreHandler = () => {
    emit("load-more")
}

const clickOnItemHandler = (id: string) => {
    emit("click-on-item", id)
}
</script>

<template>
    <media-list
        :items="items"
        :has-more="hasMore"
        :one-row="oneRow"
        @load-more="loadMoreHandler"
    >
        <template #item="{ item }">
            <artist-media-card
                :id="item"
                @click="clickOnItemHandler(item)"
            />
        </template>
    </media-list>
</template>
