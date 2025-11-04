<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { ArtistFollowButton } from "@/widgets/artist/artist-follow-button"
import { ArtistAvatar, useArtistStore } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const emit = defineEmits(["click"])

const artistStore = useArtistStore()
const { getArtistById } = storeToRefs(artistStore)

const id = computed(() => props.id)
const artist = computed(() => getArtistById.value(id.value))

const { goToArtistInfoPage } = useNavigation()

const goToArtistsInfoPageHandler = () => {
    emit("click")
    goToArtistInfoPage(id.value)
}
</script>

<template>
    <div
        class="artist-media-card"
        v-if="artist"
    >
        <artist-avatar
            :artist="artist"
            clickable
            with-overlay
            @click="goToArtistsInfoPageHandler"
        >
            <template #overlay-bottom-right>
                <artist-follow-button
                    :id="artist.id"
                    variant="ghost"
                />
            </template>
        </artist-avatar>

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
    align-items: center;
    gap: 8px;

    &__title {
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;

        &:hover {
            text-decoration: underline;
        }
    }
}
</style>
