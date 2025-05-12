<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { ArtistPageHeader } from "@/entities/artist"

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: artist } = useArtistById(id)
</script>

<template>
    <template v-if="artist">
        <artist-page-header
            :artist="artist"
            v-if="artist"
        />
        <div style="height: 400vh;"/>
    </template>
</template>

<style lang="scss">

</style>
