<script setup lang="ts">
import { useFavoriteReleases } from "../api"
import { ReleasesList } from "@/entities/release"
import { useNavigation } from "@/shared/hooks"

const { goToFavoriteReleasesPage } = useNavigation()

const { data: releases, hasMore, getMore } = useFavoriteReleases()

const loadMoreHandler = () => {
    getMore()
}

const clickOnTitleHandler = () => {
    goToFavoriteReleasesPage()
}
</script>

<template>
    <releases-list
        :releases="releases"
        :has-more="hasMore"
        @click-on-title="clickOnTitleHandler"
        @load-more="loadMoreHandler"
        v-if="releases && hasMore !== undefined"
    />
</template>
