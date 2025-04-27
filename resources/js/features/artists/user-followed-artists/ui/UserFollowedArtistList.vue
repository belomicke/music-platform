<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useUserFollowedArtists } from "../api"
import { ArtistList } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"

const props = withDefaults(defineProps<{
    id: string
    withTitle?: boolean
    oneRow?: boolean
}>(), {
    withTitle: false,
    oneRow: false,
})

const { t } = useI18n()
const { goToUserFollowedArtistsPage } = useNavigation()

const id = computed(() => props.id)

const { data: artists, hasMore, getMore } = useUserFollowedArtists(id)

const title = computed(() => {
    return props.withTitle ? t("features.artist.user-followed-artists.ui.artists-list-title") : ""
})

const loadMoreHandler = () => {
    getMore()
}
</script>

<template>
    <artist-list
        :title="title"
        :artists="artists"
        :has-more="hasMore"
        :one-row="oneRow"
        @click-on-title="goToUserFollowedArtistsPage(id)"
        @load-more="loadMoreHandler"
        v-if="artists && hasMore !== undefined"
    />
</template>

<style lang="scss">

</style>
