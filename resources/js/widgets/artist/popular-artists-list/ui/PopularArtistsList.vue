<script setup lang="ts">
import { ArtistMediaCardList } from "../../artist-media-card-list"
import { usePopularArtists } from "@/features/artists/get-popular-artists"

withDefaults(defineProps<{
    oneRow?: boolean
}>(), {
    oneRow: false,
})

const { data: artists } = usePopularArtists()
</script>

<template>
    <artist-media-card-list
        :artists="artists"
        :one-row="oneRow"
        v-if="artists.length"
    />
</template>
