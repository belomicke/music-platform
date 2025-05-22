<script setup lang="ts">
import { computed, onMounted, ref } from "vue"
import _ from "lodash"
import { TrackListItem } from "./TrackListItem"
import { MediaCarousel } from "@/shared/ui"
import type { ApiTrack } from "@/shared/api"

const props = withDefaults(defineProps<{
    tracks: ApiTrack[]
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

const items = computed(() => props.tracks.map(track => track.id))

const itemWidth = ref<number>(0)

const chunks = computed(() => {
    return _.chunk(items.value, 3)
})

const clickOnTitleHandler = () => {
    emit("click-on-title")
}

const clickOnItemHandler = (id: string) => {
    emit("click-on-item", id)
}

onMounted(() => {
    const el = document.querySelector(".app-layout-content")

    itemWidth.value = (el.clientWidth - 24 * 2) / 2 - 16
})
</script>

<template>
    <media-carousel
        class="track-carousel"
        title="Треки"
        :count="chunks.length"
        :item-width="itemWidth"
        @click-on-title="clickOnTitleHandler"
        v-if="itemWidth !== 0"
    >
        <template #item="{ item }">
            <div class="track-carousel__items">
                <track-list-item
                    :id="track"
                    class="track-carousel__item"
                    :style="{
                        'width': `${itemWidth}px`
                    }"
                    with-artists
                    with-cover
                    @click="clickOnItemHandler(track)"
                    v-for="track in chunks[item]"
                    :key="track"
                />
            </div>
        </template>
    </media-carousel>
</template>

<style lang="scss">
.track-carousel {
    &__items {
        display: flex;
        flex-direction: column;
        width: 50%;
    }

    &__item {
        width: 100%;
    }
}
</style>
