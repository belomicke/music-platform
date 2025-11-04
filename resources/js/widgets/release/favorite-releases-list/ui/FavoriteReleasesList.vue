<script setup lang="ts">
import { useFavoriteReleases } from "../../../../features/collection/get-favorite-releases/api"
import { ReleaseMediaCardList } from "@/widgets/release/release-media-card-list"

withDefaults(defineProps<{
    oneRow?: boolean
}>(), {
    oneRow: false,
})

const { data: releases, hasMore, getMore } = useFavoriteReleases()

const loadMoreHandler = () => {
    getMore()
}
</script>

<template>
    <release-media-card-list
        :releases="releases"
        :has-more="hasMore"
        :one-row="oneRow"
        @load-more="loadMoreHandler"
        v-if="releases && hasMore !== undefined"
    />
</template>
