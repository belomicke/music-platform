<script setup lang="ts">
import { PopularArtistList } from "@/features/artists/get-popular-artists"
</script>

<template>
    <div class="home-page">
        <popular-artist-list/>
    </div>
</template>

<style lang="scss">
.home-page {
    padding: 24px;
}
</style>
