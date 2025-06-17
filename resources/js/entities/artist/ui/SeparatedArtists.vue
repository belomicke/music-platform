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
            <span
                class="separated-artists__artist"
                @click="goToArtist(artist.id)"
            >
                {{ artist.name }}
            </span>
            <template v-if="index !== artists.length - 1">
                {{ ", " }}
            </template>
        </template>
    </div>
</template>

<style scoped lang="scss">
.separated-artists {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    word-break: break-all;
    -webkit-line-clamp: 1;
    font-size: 13px;
    font-weight: 500;
    line-height: 18px;
    max-height: 18px;
    color: var(--color-text-secondary);
    overflow: hidden;

    &__artist {
        color: inherit;
        cursor: pointer;
        transition: color .15s;

        &:hover {
            color: var(--color-text-primary);
        }
    }
}
</style>
