<script setup lang="ts">
import { computed, onMounted, onUnmounted, watch } from "vue"
import { useRoute } from "vue-router"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { ArtistPageHeader } from "@/entities/artist"
import { setStickyHeaderTitle } from "@/shared/ui"

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: artist } = useArtistById(id)

watch(artist, () => {
    if (artist.value) {
        setStickyHeaderTitle(artist.value.name)
    }
})

onMounted(() => {
    if (artist.value) setStickyHeaderTitle(artist.value.name)
})

onUnmounted(() => {
    setStickyHeaderTitle("")
})
</script>

<template>
    <template v-if="artist">
        <artist-page-header
            :artist="artist"
            v-if="artist"
        />
    </template>
</template>

<style lang="scss">

</style>
