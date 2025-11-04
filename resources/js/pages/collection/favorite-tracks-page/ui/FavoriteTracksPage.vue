<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { FavoriteTracksList } from "@/widgets/track/favorite-tracks-list"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"

const { t } = useI18n()

const title = computed(() => {
    return t("page.collection.followed-tracks.header.title")
})
</script>

<template>
    <app-sticky-header-content
        :title="title"
    />
    <favorite-tracks-list/>
</template>

<style lang="scss">

</style>
