<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import type { RecentSearch } from "../model"
import RecentSearchCover from "./RecentSearchCover.vue"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { ApiArtist, ApiRelease } from "@/shared/api"
import { useNavigation } from "@/shared/hooks"
import { IIcon } from "@/shared/ui"

const props = defineProps<{
    recentSearch: RecentSearch
}>()

const { t } = useI18n()

const { goToArtistInfoPage, goToReleaseInfoPage } = useNavigation()

const artistStore = useArtistStore()
const releaseStore = useReleaseStore()

const { getArtistById } = storeToRefs(artistStore)
const { getReleaseById } = storeToRefs(releaseStore)

const data = computed(() => {
    if (props.recentSearch.type === "artist") {
        return getArtistById.value(props.recentSearch.id)
    } else if (props.recentSearch.type === "release") {
        return getReleaseById.value(props.recentSearch.id)
    }
})

const title = computed(() => {
    if (props.recentSearch.type === "artist") {
        return (data.value as ApiArtist).name
    } else if (props.recentSearch.type === "release") {
        return (data.value as ApiRelease).title
    }
})

const type = computed(() => {
    if (props.recentSearch.type === "artist") {
        return t("entities.artist.single")
    } else if (props.recentSearch.type === "release") {
        return t("entities.release.single")
    }
})

const goToRecentSearch = () => {
    if (props.recentSearch.type === "artist") {
        goToArtistInfoPage(props.recentSearch.id)
    } else if (props.recentSearch.type === "release") {
        goToReleaseInfoPage(props.recentSearch.id)
    }
}
</script>

<template>
    <div
        class="recent-search-item"
        @click="goToRecentSearch"
    >
        <recent-search-cover
            :recent-search="recentSearch"
            :artist="data as ApiArtist"
            :release="data as ApiRelease"
            v-if="data"
        />
        <div class="recent-search-item__info">
            <div
                class="recent-search-item__title"
                @click="goToRecentSearch"
            >
                {{ title }}
            </div>
            <div class="recent-search-item__type">{{ type }}</div>
        </div>
        <div class="recent-search-item__controls">
            <i-icon
                icon="chevron-right"
                size="xs"
            />
        </div>
    </div>
</template>

<style scoped lang="scss">
.recent-search-item {
    display: flex;
    align-items: center;
    gap: 16px;
    cursor: pointer;
    padding: 0 8px;
    border-radius: var(--ym-radius-size-xs);
    height: 62px;
    transition: background-color .15s;

    &:hover {
        background-color: var(--color-background-hover);
    }

    &__info {
        display: flex;
        flex-direction: column;
    }

    &__title {
        font-size: var(--ym-font-size-label-m);
        line-height: var(--ym-font-line-height-label-m);
        font-weight: var(--ym-font-weight-medium);

        &:hover {
            text-decoration: underline;
        }
    }

    &__type {
        font-size: var(--ym-font-size-label-m);
        line-height: var(--ym-font-line-height-label-m);
        font-weight: var(--ym-font-weight-medium);
        color: var(--ym-controls-color-primary-text-enabled);
    }

    &__controls {
        --text-enabled-color: var(--ym-controls-color-primary-text-enabled);
        --text-hovered-color: var(--ym-controls-color-primary-text-enabled_variant);

        display: flex;
        align-items: center;
        margin-left: auto;
        color: var(--text-enabled-color);
    }
}
</style>
