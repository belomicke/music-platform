<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { usePopularArtists } from "../api"
import { ArtistCarousel } from "@/entities/artist"

const { t } = useI18n()

const { data: artists, isLoading } = usePopularArtists()
</script>

<template>
    <artist-carousel
        :artists="artists"
        :title="t('page.home.section-title.popular-artists')"
        v-if="isLoading === false"
    />
</template>
