<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { TrackPlayButton } from "../../track-play-button"
import { TrackFavoriteButton } from "../../track-follow-button"
import TrackListItemMeta from "./TrackListItemMeta.vue"
import { useTrackStore } from "@/entities/track"
import { ITimecode } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    contextId: string
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

const trackStore = useTrackStore()
const { getTrackById } = storeToRefs(trackStore)

const track = computed(() => getTrackById.value(props.id))
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
        <track-play-button
            :id="id"
            :context-id="contextId"
            :with-cover="withCover"
            :index="index"
        />
        <track-list-item-meta
            :track="track"
            :with-artists="withArtists"
        />
        <div class="track-list-item__controls">
            <track-favorite-button
                :id="track.id"
            />
            <i-timecode
                class="track-list-item__controls_item"
                :seconds="track.duration_ms / 1000"
            />
        </div>
    </div>
</template>

<style lang="scss">
.track-list-item {
    --horizontal-card-fallback-height: 3.5rem;

    display: flex;
    align-items: center;
    gap: var(--ym-spacer-size-xs);
    width: 100%;
    height: var(--horizontal-card-fallback-height);
    position: relative;
    cursor: pointer;
    border-radius: var(--ym-radius-size-s);
    padding-inline-end: var(--ym-spacer-size-xs);
    padding-inline-start: var(--ym-spacer-size-xs);
    overflow: hidden;
    transition: background-color var(--ym-duration-transition);

    &:hover {
        background-color: rgba(255, 255, 255, 0.08);
    }

    &__skeleton {
        height: 56px;
        border-radius: var(--ym-radius-size-xs);
        background-color: var(--color-background-hover);
    }

    &__controls {
        --text-enabled-color: var(--ym-controls-color-primary-text-enabled);
        --text-hovered-color: var(--ym-controls-color-primary-text-enabled_variant);

        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--ym-spacer-size-l);
        height: 100%;

        &_item {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 2.5rem;
            height: 2.5rem;
            position: relative;
        }
    }
}
</style>
