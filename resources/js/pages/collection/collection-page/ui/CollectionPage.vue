<script setup lang="ts">
import { FavoriteArtistsCarousel } from "@/features/collection/get-favorite-artists"
import { FavoriteReleasesCarousel } from "@/features/collection/get-favorite-releases"
import { FavoriteTracksPreview } from "@/features/collection/get-favorite-tracks"
import { useCollection } from "@/features/collection/get-collection"

const { data, isLoading } = useCollection()
</script>

<template>
    <div
        class="collection-page"
        v-if="isLoading === false && data !== undefined"
    >
        <favorite-tracks-preview/>
        <favorite-releases-carousel/>
        <favorite-artists-carousel/>
    </div>
</template>

<style lang="scss">
.collection-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
    padding-bottom: 24px;
}
</style>
