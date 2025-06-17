<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import TrackListItemIndex from "./TrackListItemIndex.vue"
import TrackListItemCover from "./TrackListItemCover.vue"
import TrackListItemInfo from "./TrackListItemInfo.vue"
import { TrackFavoriteButton } from "@/features/tracks/following"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { useTrackStore } from "@/entities/track"
import { ITimecode } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    queueId: string
    index: number
    withIndex?: boolean
    withArtists?: boolean
    withCover?: boolean
}>(), {
    withIndex: false,
    withArtists: false,
    withCover: false,
})

const emit = defineEmits([
    "play",
    "pause",
])

const backendPlayerStore = useBackendPlayerStore()
const { getTrack: playerTrack, getIsPlaying: playerIsPlaying } = storeToRefs(backendPlayerStore)

const trackStore = useTrackStore()
const { getById } = storeToRefs(trackStore)

const track = computed(() => getById.value(props.id))

const isActive = computed(() => {
    if (!playerTrack.value) return false

    return playerTrack.value.id === track.value.id
})

const isPlaying = computed(() => {
    return isActive.value && playerIsPlaying.value
})

const playHandler = async () => {
    if (!playerTrack.value) {
        await backendPlayerStore.setTrack(props.queueId, props.index)
    } else if (playerTrack.value.id !== props.id) {
        await backendPlayerStore.setTrack(props.queueId, props.index)
    }

    await backendPlayerStore.play()
}
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
        <track-list-item-index
            :track="track"

            :is-playing="isPlaying"
            :is-active="isActive"

            :number="index"
            @play="playHandler"
            @pause="backendPlayerStore.pause"
            v-if="withIndex"
        />
        <track-list-item-cover
            :track="track"

            :is-playing="isPlaying"
            :is-active="isActive"

            @play="playHandler"
            @pause="backendPlayerStore.pause"
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
            <i-timecode
                :seconds="track.duration_ms / 1000"
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
