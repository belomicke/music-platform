<script setup lang="ts">
import { TrackList } from "../../track-list"
import { useFavoriteTracks } from "@/features/collection/get-favorite-tracks"

const { data: tracks } = useFavoriteTracks()
</script>

<template>
    <div class="favorite-tracks">
        <track-list
            :tracks="tracks"
            context-id="favorite-tracks"
            with-artists
            with-cover
        />
    </div>
</template>

<style lang="scss">
.favorite-tracks {
    padding: 0 var(--ym-spacer-size-l);
    padding-bottom: var(--ym-spacer-size-l);
}
</style>
