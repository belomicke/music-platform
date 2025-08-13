<script setup lang="ts">
import { ApiArtist } from "@/shared/api"

defineProps<{
    artist: ApiArtist
}>()
</script>

<template>
    <a
        class="page-header-release-meta__artist-link"
        target="_self"
        rel=""
    >
        <span class="page-header-album-meta__artist-label">
            {{ artist.name }}
        </span>
    </a>
</template>

<style lang="scss">

</style>
