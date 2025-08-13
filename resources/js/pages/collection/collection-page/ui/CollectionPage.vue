<script setup lang="ts">
import { FavoriteArtistsCarousel } from "@/features/collection/get-favorite-artists"
import { FavoriteReleasesCarousel } from "@/features/collection/get-favorite-releases"
import { FavoriteTracksPreview } from "@/features/collection/get-favorite-tracks"
import { useCollection } from "@/features/collection/get-collection"
import { StickyHeaderWithNavigation, useStickyHeaderTitle } from "@/shared/ui"
import { useTitle } from "@vueuse/core"
import { computed } from "vue"

const { data, isLoading } = useCollection()

useTitle("Коллекция")

useStickyHeaderTitle(computed(() => "Коллекция"))
</script>

<template>
    <sticky-header-with-navigation/>
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

    &__title {

    }
}
</style>
