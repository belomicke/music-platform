<script setup lang="ts">
import { useFavoriteArtists } from "../api"
import { ArtistsList } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const { goToFavoriteArtistsPage } = useNavigation()

const { data: artists, hasMore, getMore } = useFavoriteArtists()

const loadMoreHandler = () => {
    getMore()
}

const clickOnTitleHandler = () => {
    goToFavoriteArtistsPage()
}
</script>

<template>
    <artists-list
        :artists="artists"
        :has-more="hasMore"
        @click-on-title="clickOnTitleHandler"
        @load-more="loadMoreHandler"
        v-if="artists && hasMore !== undefined"
    />
</template>
