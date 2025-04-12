<script setup lang="ts">
import ArtistMediaCard from "./ArtistMediaCard.vue"
import { IArtist } from "@/shared/api"

defineProps<{
    artists: IArtist[]
}>()
</script>

<template>
    <div class="artist-list">
        <artist-media-card
            :id="artist.id"
            v-for="artist in artists"
            :key="artist.id"
        />
    </div>
</template>

<style lang="scss">
.artist-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 190px));
    justify-content: space-between;
    height: 270px;
}
</style>
