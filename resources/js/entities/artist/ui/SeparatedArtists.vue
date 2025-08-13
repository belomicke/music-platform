<script setup lang="ts">
import { useNavigation } from "@/shared/hooks"
import { ApiArtist } from "@/shared/api"

defineProps<{
    artists: ApiArtist[]
}>()

const { goToArtistInfoPage } = useNavigation()

const goToArtist = (id: string) => {
    goToArtistInfoPage(id)
}
</script>

<template>
    <div class="separated-artists">
        <template
            v-for="(artist, index) in artists"
            :key="artist.id"
        >
            <router-link
                target="_self"
                rel=""
                :aria-label="`Артист ${artist.name}`"
                :to="`/artist/${artist.id}`"
                class="separated-artists__artist-link"
            >
                <span class="separated-artists__artist-label">
                    {{ artist.name }}
                </span>
            </router-link>
            <template v-if="index !== artists.length - 1">
                {{ ", " }}
            </template>
        </template>
    </div>
</template>

<style lang="scss">
.separated-artists {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    word-break: break-word;

    @media only screen and (min-width: 768px) {
        display: contents;
    }

    &__artist {
        color: inherit;
        cursor: pointer;
        transition: color .15s;

        &:hover {
            color: var(--color-text-primary);
        }
    }

    &__artist-link {
        border: none;
        cursor: pointer;
        outline: none;
        overflow: hidden;
        position: relative;
        text-decoration: none;
    }

    &__artist-label {
        color: var(--ym-controls-color-primary-text-enabled);
        font-size: var(--ym-font-size-label-m);
        letter-spacing: var(--ym-letter-spacing-m);
        line-height: var(--ym-font-line-height-label-m);
        font-weight: var(--ym-font-weight-medium);
    }

    &__artist-link:hover > &__artist-label {
        color: var(--ym-controls-color-primary-text-hovered);
    }
}
</style>
