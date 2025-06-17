<script setup lang="ts">
import { computed } from "vue"
import FavoriteTracksPageHeader from "./FavoriteTracksPageHeader.vue"
import { useFavoriteTracks } from "@/features/collection/get-favorite-tracks"
import { TrackList } from "@/entities/track"

const { data: tracks } = useFavoriteTracks()

const ids = computed(() => tracks.value.map(track => track.id))
</script>

<template>
    <div class="favorite-tracks-page">
        <favorite-tracks-page-header/>
        <div class="favorite-tracks-page__tracks">
            <track-list
                :ids="ids"
                queue-id="favorite-tracks"
                with-cover
                with-artists
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.favorite-tracks-page {
    padding-bottom: 24px;
}
</style>
