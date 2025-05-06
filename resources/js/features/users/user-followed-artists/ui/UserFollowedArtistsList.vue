<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useUserFollowedArtists } from "../api"
import ArtistMediaCard from "@/entities/artist/ui/ArtistMediaCard.vue"
import { useNavigation } from "@/shared/hooks"
import { MediaList } from "@/shared/ui"

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

const items = computed(() => artists.value.map(artist => artist.id))

const title = computed(() => {
    return props.withTitle ? t("features.user.user-followed-artists.ui.artists-list-title") : ""
})

const loadMoreHandler = () => {
    getMore()
}
</script>

<template>
    <media-list
        :title="title"
        :items="items"
        :has-more="hasMore"
        :one-row="oneRow"
        @click-on-title="goToUserFollowedArtistsPage(id)"
        @load-more="loadMoreHandler"
        v-if="artists && hasMore !== undefined"
    >
        <template #item="{ item }">
            <artist-media-card
                :id="item"
            />
        </template>
    </media-list>
</template>

<style lang="scss">

</style>
