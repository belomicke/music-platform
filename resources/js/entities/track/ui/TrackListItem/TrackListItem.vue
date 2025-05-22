<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import TrackListItemDuration from "./TrackListItemDuration.vue"
import TrackListItemNumber from "./TrackListItemNumber.vue"
import TrackListItemCover from "./TrackListItemCover.vue"
import TrackListItemInfo from "./TrackListItemInfo.vue"
import { TrackFavoriteButton } from "@/features/tracks/following"
import { useTrackStore } from "@/entities/track"

const props = withDefaults(defineProps<{
    id: string
    index?: number
    withArtists?: boolean
    withCover?: boolean
}>(), {
    index: 0,
    withArtists: false,
    withCover: false,
})

const trackStore = useTrackStore()
const { getById } = storeToRefs(trackStore)

const track = computed(() => getById.value(props.id))
</script>

<template>
    <div
        class="track-list-item__skeleton"
        v-if="track === undefined"
    />
    <div
        class="track-list-item"
        v-else
    >
        <track-list-item-number
            :number="index"
            v-if="index !== 0"
        />
        <track-list-item-cover
            :track="track"
            v-if="withCover"
        />
        <track-list-item-info
            :track="track"
            :with-artists="withArtists"
        />
        <div class="track-list-item__controls">
            <track-favorite-button
                :track="track"
            />
            <track-list-item-duration
                :track="track"
            />
        </div>
    </div>
</template>

<style lang="scss">
.track-list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    height: 56px;
    padding: 0 8px;

    cursor: pointer;

    border-radius: 6px;
    transition: background-color .3s;

    &:hover {
        background-color: rgba(255, 255, 255, 0.08);
    }

    &__skeleton {
        height: 56px;
        border-radius: 6px;
        background-color: var(--color-background-hover);
    }

    &__controls {
        display: flex;
        align-items: center;
        gap: 16px;
    }
}
</style>
