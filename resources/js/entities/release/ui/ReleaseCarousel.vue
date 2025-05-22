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
        :count="items.length"
        :item-width="200"
        :clickable-title="clickableTitle"
        @click-on-title="clickOnTitleHandler"
    >
        <template #item="{ item }">
            <release-media-card
                class="release-carousel__item"
                avatar-size="200px"
                @click="clickOnItemHandler(items[item])"
                :id="items[item]"
            />
        </template>
    </media-carousel>
</template>

<style lang="scss">
.release-carousel__item {
    width: 200px;
}
</style>
