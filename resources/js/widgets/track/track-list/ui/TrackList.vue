<script setup lang="ts">
import { TrackListItem } from "@/widgets/track/track-list-item/ui"
import { ApiTrack } from "@/shared/api"

withDefaults(defineProps<{
    tracks: ApiTrack[]
    contextId: string
    withArtists?: boolean
    twoColumns?: boolean
    withCover?: boolean
}>(), {
    withArtists: false,
    twoColumns: false,
    withCover: false,
})
</script>

<template>
    <ol
        class="track-list two-column"
        v-if="twoColumns"
    >
        <li class="track-list__list">
            <track-list-item
                :id="track.id"
                :context-id="contextId"
                :index="index + 1"
                :with-cover
                with-artists
                v-for="(track, index) in tracks.slice(0, Math.floor(tracks.length / 2))"
                :key="index"
            />
        </li>
        <li class="track-list__list">
            <track-list-item
                :id="track.id"
                :context-id="contextId"
                :index="index + 1"
                with-cover
                with-artists
                v-for="(track, index) in tracks.slice(Math.ceil(tracks.length / 2), tracks.length)"
                :key="index"
            />
        </li>
    </ol>
    <div class="track-list" v-else>
        <track-list-item
            :id="track.id"
            :context-id="contextId"
            :with-cover="withCover"
            :with-artists="withArtists"
            :index="index + 1"
            v-for="(track, index) in tracks"
            :key="index"
        />
    </div>
</template>

<style scoped lang="scss">
.track-list {
    display: flex;
    flex-direction: column;
    width: 100%;

    &__list {
        width: 100%;
    }

    &.two-column {
        flex-direction: row;
        gap: calc(var(--ym-spacer-size-m) * 2);
        padding-inline: var(--ym-spacer-size-xxl);
        width: 100%;
    }
}

ol {
    padding: 0;
    margin: 0;
}

li {
    list-style-type: none;
}
</style>
