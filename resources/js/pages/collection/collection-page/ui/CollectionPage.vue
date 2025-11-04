<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import CollectionEmptyPage from "./CollectionEmptyPage.vue"
import { FavoriteReleasesList } from "@/widgets/release/favorite-releases-list"
import { FavoriteTracksPreview } from "@/widgets/track/favorite-tracks-list"
import { FavoriteArtistsList } from "@/widgets/artist/favorite-artists-list"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"
import { useCollection } from "@/features/collection/get-collection"
import { useNavigation } from "@/shared/hooks"
import { MediaSection } from "@/shared/ui"

const { t } = useI18n()

const { data, isLoading } = useCollection()

const title = computed(() => "Коллекция")

const { goToFavoriteReleasesPage, goToFavoriteArtistsPage } = useNavigation()

const collectionIsEmpty = computed(() => {
    return data.value.tracks.count === 0 &&
        data.value.releases.count === 0 &&
        data.value.artists.count === 0
})
</script>

<template>
    <app-sticky-header-content
        :title="title"
    />
    <div
        class="collection-page"
        v-if="isLoading === false && data !== undefined"
    >
        <collection-empty-page
            v-if="collectionIsEmpty"
        />
        <template v-else>
            <favorite-tracks-preview
                v-if="data.tracks.items.length"
            />
            <media-section
                :title="t('features.collection.followed-releases.ui.list-title')"
                title-is-clickable
                @click-on-title="goToFavoriteReleasesPage"
                v-if="data.releases.items.length"
            >
                <favorite-releases-list
                    one-row
                />
            </media-section>
            <media-section
                :title="t('features.collection.followed-artists.ui.list-title')"
                title-is-clickable
                @click-on-title="goToFavoriteArtistsPage"
                v-if="data.artists.items.length"
            >
                <favorite-artists-list
                    with-title
                    one-row
                />
            </media-section>
        </template>
    </div>
</template>

<style lang="scss">
.collection-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
    height: 100%;
}
</style>
