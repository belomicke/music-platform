<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import SearchPageNoResults from "./SearchPageNoResults.vue"
import SearchPageLoader from "./SearchPageLoader.vue"
import { ReleaseMediaCardList } from "@/widgets/release/release-media-card-list"
import { ArtistMediaCardList } from "@/widgets/artist/artist-media-card-list"
import { TrackList } from "@/widgets/track/track-list"
import { useCreateRecentSearch } from "@/features/recent-searches/create-recent-search"
import { useSearch } from "@/features/search"
import { MediaSection } from "@/shared/ui"

const props = defineProps<{
    query: string
}>()

const { t } = useI18n()

const emit = defineEmits([
    "click-on-artist",
    "click-on-release",
])

const query = computed(() => props.query)

const { data: result, noResults, isLoading } = useSearch(query)

const contextId = computed(() => {
    return `search:${query.value}`
})

const { fetch: createRecentSearch } = useCreateRecentSearch()

const clickOnArtistHandler = (id: string) => {
    createRecentSearch({
        id,
        type: "artist",
    })
}

const clickOnReleaseHandler = (id: string) => {
    createRecentSearch({
        id,
        type: "release",
    })
}
</script>

<template>
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
        <media-section
            title="Треки"
            v-if="result.tracks.length"
        >
            <track-list
                :tracks="result.tracks"
                :context-id="contextId"
                with-artists
                with-cover
                two-columns
            />
        </media-section>
        <media-section
            :title="t('entities.release.plural')"
            v-if="result.releases.length"
        >
            <release-media-card-list
                :releases="result.releases"
                one-row
                @click-on-item="clickOnReleaseHandler"
            />
        </media-section>
        <media-section
            :title="t('entities.artist.plural')"
            v-if="result.artists.length"
        >
            <artist-media-card-list
                :artists="result.artists"
                one-row
                @click-on-item="clickOnArtistHandler"
            />
        </media-section>
    </div>
</template>

<style lang="scss">
.search-page-results {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding-bottom: 24px;
}
</style>
