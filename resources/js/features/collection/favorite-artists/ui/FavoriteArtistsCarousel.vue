<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useFavoriteArtists } from "../api"
import { ArtistCarousel } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const { t } = useI18n()
const { goToFavoriteArtistsPage } = useNavigation()

const id = computed(() => props.id)

const { data: artists } = useFavoriteArtists(id)

const clickOnTitleHandler = () => {
    goToFavoriteArtistsPage(props.id)
}
</script>

<template>
    <artist-carousel
        :title="t('features.user.followed-artists.ui.list-title')"
        :artists="artists"
        @click-on-title="clickOnTitleHandler"
        clickable-title
    />
</template>

<style lang="scss">

</style>
