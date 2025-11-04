<script setup lang="ts">
import { SeparatedArtists } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"
import { ApiTrack } from "@/shared/api"

const props = defineProps<{
    track: ApiTrack | undefined
    withArtists: boolean
}>()

const { goToArtistInfoPage, goToReleaseInfoPage } = useNavigation()

const goToArtist = (id: string) => {
    goToArtistInfoPage(id)
}

const goToRelease = () => {
    goToReleaseInfoPage(props.track.release.id)
}
</script>

<template>
    <div class="meta">
        <div class="meta__container">
            <div class="meta__title-container">
                <span
                    class="meta__title"
                    @click="goToRelease"
                >
                    {{ track.title }}
                </span>
            </div>
            <separated-artists
                :artists="track.artists"
                variant="secondary"
                v-if="withArtists || track.artists.length > 1"
            />
        </div>
    </div>
</template>

<style lang="scss">
.meta {
    display: flex;
    flex: 1 1;
    align-items: center;
    overflow: hidden;

    --text-enabled-color: var(--ym-controls-color-primary-text-enabled);
    --text-hovered-color: var(--ym-controls-color-primary-text-enabled_variant);
    --text-disabled-color: var(--ym-controls-color-primary-text-disabled);

    &__container {
        overflow: hidden;
    }

    &__title-container {
        display: flex;
        align-items: center;
        color: var(--text-hovered-color);
        overflow: hidden;
    }

    &__title {
        display: block;
        cursor: pointer;
        font-size: var(--ym-font-size-label-m);
        font-weight: var(--ym-font-weight-medium);
        line-height: var(--ym-font-line-height-label-m);

        color: var(--text-hovered-color);

        -webkit-line-clamp: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

        transition: color var(--ym-duration-transition);

        &:hover {
            text-decoration: underline;
        }
    }

    &__artist {
        cursor: pointer;
        color: var(--color-text-secondary);
        transition: color .15s;

        &:hover {
            color: var(--color-text-secondary-hover);
        }
    }
}
</style>
