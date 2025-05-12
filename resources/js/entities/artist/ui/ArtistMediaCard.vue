<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { ArtistFollowButton } from "@/features/artists/following"
import { useCompactArtistStore } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const compactArtistStore = useCompactArtistStore()
const { getById: getCompactArtistById } = storeToRefs(compactArtistStore)

const id = computed(() => props.id)
const artist = computed(() => getCompactArtistById.value(id.value))

const { goToArtistInfoPage } = useNavigation()

const goToArtistsInfoPageHandler = () => {
    goToArtistInfoPage(id.value)
}
</script>

<template>
    <div
        class="artist-media-card"
        v-if="artist"
    >
        <div class="header">
            <div
                class="avatar"
                :style="{
                'background-image': `url(${artist.image_url})`
            }"
                @click="goToArtistsInfoPageHandler"
            />
            <div class="overlay">
                <div class="overlay__actions top"></div>
                <div class="overlay__actions bottom">
                    <div></div>
                    <artist-follow-button
                        class="overlay__action"
                        :id="artist.id"
                        variant="primary"
                        :size="42"
                        :icon-size="20"
                    />
                </div>
            </div>
        </div>

        <div
            class="artist-media-card__title"
            @click="goToArtistsInfoPageHandler"
        >
            {{ artist.name }}
        </div>
    </div>
</template>

<style scoped lang="scss">
.artist-media-card {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;

    min-width: 10.75rem;

    &__title {
        font-size: 16px;
        font-weight: 500;
        user-select: none;
        cursor: pointer;

        &:hover {
            text-decoration: underline;
        }
    }
}

.header {
    position: relative;
    width: 100%;
}

.avatar {
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
    cursor: pointer;

    &::after {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        transition: background-color .15s;

        .header:hover & {
            background-color: var(--overlay-background-color);
        }
    }
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;

    &__actions {
        position: absolute;
        left: 0;
        padding: 0 10px;
        width: 100%;

        &.top {
            top: 0;
            opacity: 0;
            transition: top .15s, opacity .15s;

            .header:hover & {
                top: 10px;
                opacity: 1;
            }
        }

        &.bottom {
            display: flex;
            justify-content: space-between;
            bottom: 0;
            opacity: 0;
            transition: bottom .15s, opacity .15s;

            .header:hover & {
                bottom: 10px;
                opacity: 1;
            }
        }
    }

    &__action {
        pointer-events: all;
    }
}
</style>
