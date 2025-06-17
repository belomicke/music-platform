<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import type { RecentSearch } from "../model"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { ApiArtist, ApiRelease } from "@/shared/api"
import { useNavigation } from "@/shared/hooks"
import { IAvatar } from "@/shared/ui"

const props = defineProps<{
    recentSearch: RecentSearch
}>()

const { t } = useI18n()

const { goToArtistInfoPage, goToReleaseInfoPage } = useNavigation()

const releaseStore = useReleaseStore()
const artistStore = useArtistStore()

const { getById: getArtistById } = storeToRefs(artistStore)
const { getById: getReleaseById } = storeToRefs(releaseStore)

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
        <i-avatar
            :url="data.image_url"
            :round="recentSearch.type === 'artist'"
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
    </div>
</template>

<style scoped lang="scss">
.recent-search-item {
    display: flex;
    align-items: center;
    gap: 16px;
    cursor: pointer;
    padding: 0 8px;
    border-radius: 6px;
    height: 56px;
    transition: background-color .15s;

    &:hover {
        background-color: var(--color-background-hover);
    }

    &__info {
        display: flex;
        flex-direction: column;
    }

    &__title {
        font-size: 14px;
        font-weight: 500;

        &:hover {
            text-decoration: underline;
        }
    }

    &__type {
        font-size: 14px;
        font-weight: 500;
        color: var(--color-text-secondary);
    }
}
</style>
