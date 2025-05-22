<script setup lang="ts">
import TrackListItemPlayButton from "./TrackListItemPlayButton.vue"
import type { ApiTrack } from "@/shared/api"
import { IAvatar } from "@/shared/ui"

defineProps<{
    track: ApiTrack | undefined
}>()
</script>

<template>
    <div class="track-list-item-cover__container">
        <i-avatar
            class="track-list-item-cover"
            :url="track.releases[0].image_url"
            size="40px"
        />
        <track-list-item-play-button/>
    </div>
</template>

<style lang="scss">
.track-list-item-cover {
    width: 40px;

    &__container {
        position: relative;

        &::after {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            border-radius: 6px;

            .track-list-item:hover & {
                background-color: var(--overlay-background-color);
            }
        }
    }
}
</style>
