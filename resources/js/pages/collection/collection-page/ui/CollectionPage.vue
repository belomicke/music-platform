<script setup lang="ts">
import { onMounted } from "vue"
import { FavoriteArtistsCarousel } from "@/features/collection/get-favorite-artists"
import { FavoriteReleasesCarousel } from "@/features/collection/get-favorite-releases"
import { FavoriteTracksPreview } from "@/features/collection/get-favorite-tracks"
import { useCollection } from "@/features/collection/get-collection"

const { data, fetch: getCollection, isLoading } = useCollection()

onMounted(() => {
    getCollection()
})
</script>

<template>
    <div
        class="collection-page"
        v-if="isLoading === false && data !== undefined"
    >
        <favorite-tracks-preview/>
        <favorite-artists-carousel/>
        <favorite-releases-carousel/>
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
