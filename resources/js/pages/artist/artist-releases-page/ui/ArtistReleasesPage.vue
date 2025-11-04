<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import { ArtistReleasesList } from "@/widgets/release/artist-releases-list"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"
import { useArtistStore } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const { t } = useI18n()
const route = useRoute()

const { goToHomePage } = useNavigation()

const id = computed(() => {
    return route.params.id as string
})

const artistStore = useArtistStore()
const { getArtistById } = storeToRefs(artistStore)

const artist = computed(() => {
    return getArtistById.value(id.value)
})

const title = computed(() => {
    if (artist.value === undefined) return ""

    return t("entities.release.plural") + ` ${artist.value.name}`
})

const notFoundHandler = () => {
    goToHomePage()
}
</script>

<template>
    <app-sticky-header-content
        :title="title"
    />
    <artist-releases-list
        :id="id"
        @not-found="notFoundHandler"
    />
</template>

<style lang="scss">

</style>
