<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { usePopularArtists } from "../api"
import ArtistMediaCard from "@/entities/artist/ui/ArtistMediaCard.vue"
import { MediaList } from "@/shared/ui"

const { t } = useI18n()

const { data: artists, isLoading } = usePopularArtists()

const items = computed(() => artists.value.map(artist => artist.id))
</script>

<template>
    <media-list
        :title="t('page.home.section-title.popular-artists')"
        :items="items"
        :has-more="false"
        one-row
        v-if="isLoading === false"
    >
        <template #item="{ item }">
            <artist-media-card
                :id="item"
            />
        </template>
    </media-list>
</template>
