<script setup lang="ts">
import { computed } from "vue"
import ReleaseMediaCard from "./ReleaseMediaCard.vue"
import type { ApiRelease } from "@/shared/api"
import { MediaCarousel } from "@/shared/ui"

const props = withDefaults(defineProps<{
    releases: ApiRelease[]
    title?: string
    clickableTitle?: boolean
}>(), {
    title: "",
    clickableTitle: false,
})

const emit = defineEmits([
    "click-on-title",
    "click-on-item",
])

const items = computed(() => props.releases.map(release => release.id))

const clickOnTitleHandler = () => {
    emit("click-on-title")
}

const clickOnItemHandler = (id: string) => {
    emit("click-on-item", id)
}
</script>

<template>
    <media-carousel
        :title="title"
        :items="items"
        :clickable-title="clickableTitle"
        @click-on-title="clickOnTitleHandler"
    >
        <template #item="{ item }">
            <release-media-card
                @click="clickOnItemHandler(item)"
                :id="item"
            />
        </template>
    </media-carousel>
</template>
