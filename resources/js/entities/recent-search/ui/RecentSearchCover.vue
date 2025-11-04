<script setup lang="ts">
import type { RecentSearch } from "@/entities/recent-search"
import { ReleaseCover } from "@/entities/release"
import { ArtistAvatar } from "@/entities/artist"
import { ApiArtist, ApiRelease } from "@/shared/api"

defineProps<{
    recentSearch: RecentSearch
    artist?: ApiArtist
    release?: ApiRelease
}>()
</script>

<template>
    <artist-avatar
        :artist="artist"
        size="46px"
        icon-size="xs"
        v-if="recentSearch.type === 'artist'"
    />
    <release-cover
        :url="release.image_url"
        size="46px"
        icon-size="xs"
        v-else-if="recentSearch.type === 'release'"
    />
</template>

<style lang="scss">

</style>
