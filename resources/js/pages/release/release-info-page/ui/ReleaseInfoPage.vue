<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import ReleaseInfoPageHeader from "./ReleaseInfoPageHeader.vue"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"
import { useReleaseById } from "@/features/releases/get-release-by-id"
import { useNavigation } from "@/shared/hooks"
import { ReleaseTrackList } from "@/widgets/track/release-track-list"

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
</script>

<template>
    <app-sticky-header-content
        :title="release.title"
        v-if="release"
    />
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

<style lang="scss">

</style>
