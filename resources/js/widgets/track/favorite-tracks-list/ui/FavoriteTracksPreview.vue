<script setup lang="ts">
import { computed } from "vue"
import _ from "lodash"
import { TrackListItem } from "@/widgets/track/track-list-item"
import { useFavoriteTracks } from "@/features/collection/get-favorite-tracks"
import { useCurrentUser } from "@/features/auth/current-user"
import { useNavigation } from "@/shared/hooks"
import { IAvatar } from "@/shared/ui"

const COLUMN_SIZE = 5

const { data: user } = useCurrentUser()
const { data: tracks } = useFavoriteTracks()

const { goToFavoriteTracksPage } = useNavigation()

const columns = computed(() => {
    return _.chunk(tracks.value.splice(0, 10), COLUMN_SIZE)
})
</script>

<template>
    <div
        class="favorite-tracks-preview"
        v-if="columns.length"
    >
        <div class="favorite-tracks-preview__header">
            <i-avatar
                icon="heart"
                size="58px"
            />
            <div class="favorite-tracks-preview__info">
                <div
                    class="favorite-tracks-preview__title"
                    @click="goToFavoriteTracksPage"
                >
                    Мне нравится
                </div>
                <div class="favorite-tracks-preview__subtitle">
                    {{ user.favorite_tracks_count }} треков
                </div>
            </div>
        </div>
        <div class="favorite-tracks-preview__tracks">
            <div
                class="favorite-tracks-preview__column"
                v-for="(column, columnIndex) in columns"
                :key="columnIndex"
            >
                <track-list-item
                    :id="track.id"
                    context-id="favorite-tracks"
                    :data-index="columnIndex * COLUMN_SIZE + (trackIndex + 1)"
                    :index="columnIndex * COLUMN_SIZE + (trackIndex + 1)"
                    with-cover
                    with-artists
                    v-for="(track, trackIndex) in column"
                    :key="track.id"
                />
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.favorite-tracks-preview {
    padding: 0 24px;

    &__header {
        display: flex;
        gap: 12px;
        padding: 12px 8px 16px;
    }

    &__info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    &__title {
        cursor: pointer;
        font-size: 24px;
        line-height: 26px;
        font-weight: 700;
    }

    &__subtitle {
        font-size: 14px;
        line-height: 20px;
        font-weight: 500;
        color: var(--color-text-secondary);
        cursor: default;
    }

    &__tracks {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
}
</style>
