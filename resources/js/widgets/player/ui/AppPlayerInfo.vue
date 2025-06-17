<script setup lang="ts">
import { TrackFavoriteButton } from "@/features/tracks/following"
import { SeparatedArtists } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"
import { ApiTrack } from "@/shared/api"
import { IAvatar } from "@/shared/ui"

const props = defineProps<{
    track: ApiTrack
}>()

const { goToReleaseInfoPage } = useNavigation()

const goToReleaseHandler = () => {
    goToReleaseInfoPage(props.track.releases[0].id)
}
</script>

<template>
    <div class="app-player-info" v-if="track">
        <div class="app-player-info__info-card">
            <i-avatar
                size="64px"
                :url="track.releases[0].image_url"
            />
            <div class="app-player-info__description">
                <div class="app-player-info__title-container">
                    <div
                        class="app-player-info__title"
                        @click="goToReleaseHandler"
                    >
                        <span>{{ track.title }}</span>
                    </div>
                    <separated-artists
                        :artists="track.artists"
                    />
                </div>
            </div>
        </div>
        <div class="app-player-info__actions">
            <track-favorite-button
                :track="track"
                :size="44"
                :icon-size="24"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.app-player-info {
    display: flex;
    gap: 12px;

    &__info-card {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    &__title {
        display: -webkit-box;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-line-clamp: 1;
        word-break: break-all;
        -webkit-box-orient: vertical;

        &:hover {
            text-decoration: underline;
        }
    }

    &__actions {
        display: flex;
        align-items: center;
    }
}
</style>
