<script setup lang="ts">
import { computed, onMounted, onUnmounted } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import SearchPageNoResults from "./SearchPageNoResults.vue"
import SearchPageLoader from "./SearchPageLoader.vue"
import SearchPageInput from "./SearchPageInput.vue"
import RecentSearches from "./RecentSearches.vue"
import { useCreateRecentSearch } from "@/features/recent-searches/create-recent-search"
import TrackCarousel from "@/entities/track/ui/TrackCarousel.vue"
import { useSearch } from "@/features/search"
import { ReleaseCarousel } from "@/entities/release"
import { ArtistCarousel } from "@/entities/artist"
import { setStickyHeaderIsMount } from "@/shared/ui"
import { SearchType } from "@/shared/api"

const { t } = useI18n()
const route = useRoute()

const query = computed(() => {
    return route.query.q as string ?? ""
})

const type = computed((): SearchType => "all")
const bestResults = computed(() => true)

const { data, noResults, isLoading } = useSearch(query, type, bestResults)

const { fetch: createRecentSearch } = useCreateRecentSearch()

const queueId = computed(() => {
    return `search:${query.value}`
})

onMounted(() => {
    setStickyHeaderIsMount(false)
})

onUnmounted(() => {
    setStickyHeaderIsMount(true)
})

const clickOnArtistMediaCardHandler = (id: string) => {
    createRecentSearch({
        id,
        type: "artist",
    })
}

const clickOnReleaseMediaCardHandler = (id: string) => {
    createRecentSearch({
        id,
        type: "release",
    })
}
</script>

<template>
    <div class="search-page">
        <div class="search-page-input">
            <search-page-input/>
        </div>
        <template v-if="query.length">
            <search-page-no-results
                v-if="noResults"
            />
            <search-page-loader
                v-else-if="isLoading"
            />
            <div
                class="search-page-results"
                v-else
            >
                <template v-if="type === 'all'">
                    <track-carousel
                        :tracks="data.tracks"
                        :queue-id="queueId"
                        :title="t('entities.artist.plural')"
                        v-if="data.tracks.length"
                    />
                    <artist-carousel
                        :artists="data.artists"
                        :title="t('entities.artist.plural')"
                        v-if="data.artists.length"
                        @click-on-item="clickOnArtistMediaCardHandler"
                    />
                    <release-carousel
                        :releases="data.releases"
                        :title="t('entities.release.plural')"
                        v-if="data.releases.length"
                        @click-on-item="clickOnReleaseMediaCardHandler"
                    />
                </template>
            </div>
        </template>
        <recent-searches v-else/>
    </div>
</template>

<style scoped lang="scss">
.search-page {
    display: flex;
    flex-direction: column;
    gap: 24px;
    padding: 24px 0;
    height: 100%;
}

.search-page-input {
    padding: 0 24px;
}

.search-page-results {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding-bottom: 24px;
}
</style>
