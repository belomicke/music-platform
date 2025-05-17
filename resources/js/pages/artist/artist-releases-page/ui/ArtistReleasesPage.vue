<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import { useArtistReleases } from "@/features/releases/get-artist-releases"
import { useCompactArtistStore } from "@/entities/artist"
import { ReleasesList } from "@/entities/release"
import { MediaListPage, useStickyHeaderTitle } from "@/shared/ui"

const { t } = useI18n()
const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: releases } = useArtistReleases(id)

const compactArtistStore = useCompactArtistStore()
const { getById } = storeToRefs(compactArtistStore)

const artist = computed(() => {
    return getById.value(id.value)
})

const title = computed(() => {
    return t("entities.release.plural") + ` ${artist.value.name}`
})

useStickyHeaderTitle(title)
</script>

<template>
    <media-list-page
        :title="title"
        v-if="artist"
    >
        <releases-list
            :releases="releases"
            :has-more="false"
        />
    </media-list-page>
</template>

<style scoped lang="scss">

</style>
