<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { FavoriteArtistsList } from "@/features/collection/get-favorite-artists"
import { MediaListPage, useStickyHeaderTitle } from "@/shared/ui"

const { t } = useI18n()

const title = computed(() => {
    return t("entities.artist.plural")
})

useStickyHeaderTitle(title)
</script>

<template>
    <media-list-page :title="title">
        <favorite-artists-list/>
    </media-list-page>
</template>
