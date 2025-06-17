<script setup lang="ts">
import { TrackListItem } from "./TrackListItem"

withDefaults(defineProps<{
    ids: string[]
    queueId: string
    withArtists?: boolean
    withCover?: boolean,
    withIndex?: boolean
}>(), {
    withArtists: false,
    withCover: false,
    withIndex: false,
})
</script>

<template>
    <div class="track-list">
        <track-list-item
            :id="id"
            :queue-id="queueId"
            :with-cover="withCover"
            :with-artists="withArtists"
            :with-index="withIndex"
            :index="index + 1"
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
