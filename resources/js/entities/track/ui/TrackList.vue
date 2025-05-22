<script setup lang="ts">
import { computed } from "vue"
import { TrackListItem } from "./TrackListItem"
import { useTracks } from "@/features/tracks/get-tracks"

const props = withDefaults(defineProps<{
    ids: string[]
    withArtists?: boolean
    withCover?: boolean,
    withIndex?: boolean
}>(), {
    withArtists: false,
    withCover: false,
    withIndex: false,
})

useTracks(computed(() => props.ids))
</script>

<template>
    <div class="track-list">
        <track-list-item
            :id="id"
            :with-cover="withCover"
            :with-artists="withArtists"
            :index="withIndex ? index + 1 : 0"
            v-for="(id, index) in ids"
            :key="index"
        />
    </div>
</template>

<style scoped lang="scss">
.track-list {
    display: flex;
    flex-direction: column;
    padding: 0 24px;
}
</style>
