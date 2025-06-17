<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useArtistReleases } from "../api"
import { ReleaseCarousel } from "@/entities/release"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const { t } = useI18n()
const { goToArtistReleasesPage } = useNavigation()

const id = computed(() => props.id)

const { data: releases } = useArtistReleases(id)

const clickOnTitleHandler = () => {
    goToArtistReleasesPage(id.value)
}
</script>

<template>
    <release-carousel
        :title="t('entities.release.plural')"
        :releases="releases"
        clickable-title
        @click-on-title="clickOnTitleHandler"
        v-if="releases.length"
    />
</template>
