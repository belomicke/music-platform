<script setup lang="ts">
import { computed, onMounted, onUnmounted } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import SearchPageNoResults from "./SearchPageNoResults.vue"
import SearchPageLoader from "./SearchPageLoader.vue"
import SearchPageInput from "./SearchPageInput.vue"
import RecentSearches from "./RecentSearches.vue"
import { SearchType, useSearch } from "@/features/search"
import { ReleaseCarousel } from "@/entities/release"
import { ArtistCarousel } from "@/entities/artist"
import { setStickyHeaderIsMount } from "@/shared/ui"

const { t } = useI18n()
const route = useRoute()

const query = computed(() => {
    return route.query.q as string ?? ""
})

const type = computed((): SearchType => "all")
const bestResults = computed(() => true)

const { data, noResults, isLoading } = useSearch(query, type, bestResults)

onMounted(() => {
    setStickyHeaderIsMount(false)
})

onUnmounted(() => {
    setStickyHeaderIsMount(true)
})
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
                    <artist-carousel
                        :artists="data.artists"
                        :title="t('entities.artist.plural')"
                        v-if="data.artists.length"
                    />
                    <release-carousel
                        :releases="data.releases"
                        :title="t('entities.release.plural')"
                        v-if="data.releases.length"
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
}
</style>
