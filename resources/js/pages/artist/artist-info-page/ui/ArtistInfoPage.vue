<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import ArtistPageHeader from "./ArtistPageHeader.vue"
import { ArtistReleasesList } from "@/widgets/release/artist-releases-list"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { useNavigation } from "@/shared/hooks"
import { MediaSection } from "@/shared/ui"

const route = useRoute()

const { t } = useI18n()
const { goToHomePage, goToArtistReleasesPage } = useNavigation()

const id = computed(() => {
    return route.params.id as string
})

const { data: artist } = useArtistById(id, {
    onError: (error) => {
        if (error.status === 404) {
            goToHomePage()
        }
    },
})

const clickOnTitleHandler = () => {
    goToArtistReleasesPage(id.value)
}
</script>

<template>
    <app-sticky-header-content
        v-if="artist"
    />
    <div
        class="artist-info-page"
        v-if="artist"
    >
        <artist-page-header
            :artist="artist"
        />
        <div class="content">
            <media-section
                :title="t('entities.release.plural')"
                title-is-clickable
                @click-on-title="clickOnTitleHandler"
            >
                <artist-releases-list
                    :id="artist.id"
                    one-row
                />
            </media-section>
        </div>
    </div>
</template>

<style lang="scss">

</style>
