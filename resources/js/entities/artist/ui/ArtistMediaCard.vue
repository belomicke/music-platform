<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
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
    <div class="artist-media-card">
        <div
            class="artist-media-card__avatar"
            :style="{
                'background-image': `url(${artist.image_url})`
            }"
            @click="goToArtistsInfoPageHandler"
        />
        <div
            class="artist-media-card__title"
            @click="goToArtistsInfoPageHandler"
        >
            {{ artist.name }}
        </div>
    </div>
</template>

<style lang="scss">
.artist-media-card {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;

    min-width: 10.75rem;

    &__avatar {
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
        }

        &:hover {
            &::after {
                background-color: rgba(0, 0, 0, .5);
            }
        }
    }

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
</style>
