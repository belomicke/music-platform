<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { useFavoriteReleases } from "../api"
import { ReleaseCarousel } from "@/entities/release"
import { useNavigation } from "@/shared/hooks"

const { t } = useI18n()
const { goToFavoriteReleasesPage } = useNavigation()

const { data: releases } = useFavoriteReleases()

const clickOnTitleHandler = () => {
    goToFavoriteReleasesPage()
}
</script>

<template>
    <release-carousel
        :title="t('features.collection.followed-releases.ui.list-title')"
        :releases="releases"
        @click-on-title="clickOnTitleHandler"
        clickable-title
        v-if="releases.length"
    />
</template>
