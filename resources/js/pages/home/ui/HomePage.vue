<script setup lang="ts">
import HomePageSection from "./HomePageSection.vue"
import { usePopularArtists } from "@/features/artist/get-popular-artists"
import { ArtistList } from "@/entities/artist"

const { data: artists, isLoading } = usePopularArtists()
</script>

<template>
    <div class="home-page">
        <home-page-section>
            <artist-list
                :artists="artists"
                v-if="isLoading === false"
            />
        </home-page-section>
    </div>
</template>

<style lang="scss">
.home-page {
    padding: 10px;
}
</style>
