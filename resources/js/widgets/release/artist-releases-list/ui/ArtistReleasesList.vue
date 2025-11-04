<script setup lang="ts">
import { computed } from "vue"
import { ReleaseMediaCardList } from "@/widgets/release/release-media-card-list"
import { useArtistReleases } from "@/features/artists/get-artist-releases"

const props = withDefaults(defineProps<{
    id: string
    oneRow?: boolean
}>(), {
    oneRow: false,
})

const emit = defineEmits(["not-found"])

const id = computed(() => props.id)

const {
    releases,
    hasMore,
    getMore: loadMoreHandler,
} = useArtistReleases(id, {
    onError: (error) => {
        if (error.status === 404) {
            emit("not-found")
        }
    },
})
</script>

<template>
    <release-media-card-list
        :releases="releases"
        :has-more="hasMore"
        :one-row="oneRow"
        @load-more="loadMoreHandler"
        v-if="releases.length"
    />
</template>
