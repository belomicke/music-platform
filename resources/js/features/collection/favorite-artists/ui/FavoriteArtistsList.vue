<script setup lang="ts">
import { computed } from "vue"
import { useFavoriteArtists } from "../api"
import { ArtistsList } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const { goToFavoriteArtistsPage } = useNavigation()

const id = computed(() => props.id)

const { data: artists, hasMore, getMore } = useFavoriteArtists(id)

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

<style lang="scss">

</style>
