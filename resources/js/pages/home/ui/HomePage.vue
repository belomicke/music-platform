<script setup lang="ts">
import { PopularArtistsCarousel } from "@/features/artists/get-popular-artists"
</script>

<template>
    <div class="home-page">
        <popular-artists-carousel/>
    </div>
</template>

<style lang="scss">
.home-page {
    padding-bottom: 24px;
}
</style>
