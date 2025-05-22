<script setup lang="ts">
import { ApiTrack } from "@/shared/api"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    track: ApiTrack | undefined
    withArtists: boolean
}>()

const { goToArtistInfoPage, goToReleaseInfoPage } = useNavigation()

const goToArtist = (id: string) => {
    goToArtistInfoPage(id)
}

const goToRelease = () => {
    goToReleaseInfoPage(props.track.releases[0].id)
}
</script>

<template>
    <div class="info">
        <div class="info__container">
            <div class="info__title">
                <span @click="goToRelease">{{ track.title }}</span>
            </div>
            <div
                class="info__artists"
                v-if="withArtists"
            >
                <template
                    v-for="(artist, index) in track.artists"
                    :key="artist.id"
                >
                    <span
                        class="info__artist"
                        @click="goToArtist(artist.id)"
                    >
                        {{ artist.name }}
                    </span>
                    <template v-if="index + 1 !== track.artists.length">
                        {{ ", " }}
                    </template>
                </template>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.info {
    display: flex;
    flex: 1 1;
    flex-direction: column;

    font-size: 14px;
    font-weight: 500;
    line-height: 20px;

    width: 100%;

    &__title > span {
        cursor: pointer;
        color: var(--color-text-primary);

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
