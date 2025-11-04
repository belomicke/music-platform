<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { FavoriteReleasesList } from "@/widgets/release/favorite-releases-list"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"

const { t } = useI18n()

const title = computed(() => {
    return t("page.collection.followed-releases.header.title")
})
</script>

<template>
    <app-sticky-header-content
        :title="title"
    />
    <favorite-releases-list/>
</template>
