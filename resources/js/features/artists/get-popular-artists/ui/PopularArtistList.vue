<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { usePopularArtists } from "../api"
import { ArtistList } from "@/entities/artist"

const { t } = useI18n()

const { data: artists, isLoading } = usePopularArtists()
</script>

<template>
    <artist-list
        :title="t('page.home.section-title.popular-artists')"
        :artists="artists"
        :has-more="false"
        one-row
        v-if="isLoading === false"
    />
</template>
