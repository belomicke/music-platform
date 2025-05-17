<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { useFavoriteArtists } from "../api"
import { ArtistCarousel } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const { t } = useI18n()
const { goToFavoriteArtistsPage } = useNavigation()

const { data: artists } = useFavoriteArtists()

const clickOnTitleHandler = () => {
    goToFavoriteArtistsPage()
}
</script>

<template>
    <artist-carousel
        :title="t('features.collection.followed-artists.ui.list-title')"
        :artists="artists"
        @click-on-title="clickOnTitleHandler"
        clickable-title
    />
</template>
