<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import ReleaseInfoPageHeader from "./ReleaseInfoPageHeader.vue"
import { ReleaseTrackList } from "@/features/releases/get-release-tracks"
import { useReleaseById } from "@/features/releases/get-release-by-id"
import { useStickyHeaderTitle } from "@/shared/ui"
import { useNavigation } from "@/shared/hooks"

const route = useRoute()

const { goToHomePage } = useNavigation()

const id = computed(() => {
    return route.params.id as string
})

const { data: release } = useReleaseById(id, {
    onError: (err) => {
        if (err.status === 404) {
            goToHomePage()
        }
    },
})

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
        <div class="content">
            <release-track-list
                :id="release.id"
            />
        </div>
    </div>
</template>

<style lang="scss" scoped>
.content {
    padding: 0 0 24px;
}
</style>
