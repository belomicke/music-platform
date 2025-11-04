<script setup lang="ts">
import { ArtistMediaCardList } from "../../artist-media-card-list"
import { useFavoriteArtists } from "@/features/collection/get-favorite-artists"

withDefaults(defineProps<{
    oneRow?: boolean
}>(), {
    oneRow: false,
})

const { data: artists, hasMore, getMore } = useFavoriteArtists()

const loadMoreHandler = () => {
    getMore()
}
</script>

<template>
    <artist-media-card-list
        :artists="artists"
        :has-more="hasMore"
        :one-row="oneRow"
        @load-more="loadMoreHandler"
        v-if="artists && hasMore !== undefined"
    />
</template>
