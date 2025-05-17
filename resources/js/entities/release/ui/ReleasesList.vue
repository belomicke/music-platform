<script setup lang="ts">
import { computed } from "vue"
import ReleaseMediaCard from "./ReleaseMediaCard.vue"
import { ApiRelease } from "@/shared/api"
import { MediaList } from "@/shared/ui"

const props = defineProps<{
    releases: ApiRelease[]
    hasMore: boolean
}>()

const emit = defineEmits(["load-more", "click-on-title"])

const items = computed(() => props.releases.map(release => release.id))

const loadMoreHandler = () => {
    emit("load-more")
}

const clickOnTitleHandler = () => {
    emit("click-on-title")
}
</script>

<template>
    <media-list
        :items="items"
        :has-more="hasMore"
        @click-on-title="clickOnTitleHandler"
        @load-more="loadMoreHandler"
    >
        <template #item="{ item }">
            <release-media-card
                :id="item"
            />
        </template>
    </media-list>
</template>
