<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import ReleaseInfoPageHeader from "./ReleaseInfoPageHeader.vue"
import { useReleaseById } from "@/features/releases/get-release-by-id"
import { TrackList } from "@/entities/track"
import { useStickyHeaderTitle } from "@/shared/ui"

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: release } = useReleaseById(id)

useStickyHeaderTitle(computed(() => {
    if (!release.value) return ""

    return release.value.title
}))
</script>

<template>
    <div
        class="release-info-page"
        v-if="release"
    >
        <release-info-page-header
            :release="release"
        />
        <track-list
            :ids="release.tracks"
            with-index
        />
    </div>
</template>
