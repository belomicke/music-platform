<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { ArtistFollowButton } from "@/features/artists/following"
import { useCompactArtistStore } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"
import { IAvatar } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string,
    avatarSize?: string
}>(), {
    avatarSize: "100%",
})

const emit = defineEmits(["click"])

const compactArtistStore = useCompactArtistStore()
const { getById: getCompactArtistById } = storeToRefs(compactArtistStore)

const id = computed(() => props.id)
const artist = computed(() => getCompactArtistById.value(id.value))

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
        <i-avatar
            :url="artist.image_url"
            :size="avatarSize"
            round
            clickable
            with-overlay
            @click="goToArtistsInfoPageHandler"
        >
            <template #overlay-bottom>
                <div></div>
                <artist-follow-button
                    class="overlay__action"
                    :id="artist.id"
                    variant="primary"
                    :size="42"
                    :icon-size="20"
                />
            </template>
        </i-avatar>

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
