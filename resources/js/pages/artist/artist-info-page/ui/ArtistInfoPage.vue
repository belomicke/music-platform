<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { ArtistReleasesCarousel } from "@/features/releases/get-artist-releases"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { ArtistPageHeader } from "@/entities/artist"
import { useStickyHeaderTitle } from "@/shared/ui"

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: artist } = useArtistById(id)

useStickyHeaderTitle(computed(() => {
    if (!artist.value) return ""

    return artist.value.name
}))
</script>

<template>
    <div
        class="artist-info-page"
        v-if="artist"
    >
        <artist-page-header
            :artist="artist"
        />
        <div class="content">
            <artist-releases-carousel
                :id="artist.id"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.content {
    padding: 0 0 24px;
}
</style>
