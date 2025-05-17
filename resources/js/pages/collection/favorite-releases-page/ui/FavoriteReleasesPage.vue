<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { FavoriteReleasesList } from "@/features/collection/get-favorite-releases"
import { MediaListPage, useStickyHeaderTitle } from "@/shared/ui"

const { t } = useI18n()

const title = computed(() => {
    return t("page.collection.followed-releases.header.title")
})

useStickyHeaderTitle(title)
</script>

<template>
    <media-list-page :title="title">
        <favorite-releases-list/>
    </media-list-page>
</template>
