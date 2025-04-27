<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, useTemplateRef } from "vue"
import _ from "lodash"
import ArtistMediaCard from "./ArtistMediaCard.vue"
import ArtistListRow from "./ArtistListRow.vue"
import { IInfiniteScroll, IVirtualScroll } from "@/shared/ui"
import type { ApiCompactArtist } from "@/shared/api"

const props = withDefaults(defineProps<{
    artists: ApiCompactArtist[]
    hasMore: boolean
    title?: string
    oneRow?: boolean
}>(), {
    title: "",
    oneRow: false,
})

const emit = defineEmits(["click-on-title", "load-more"])

const clickOnTitleHandler = () => {
    emit("click-on-title")
}

const artistListRef = useTemplateRef("artistListRef")

const itemsCountPerRow = ref<number | undefined>(undefined)

onMounted(() => {
    calculateItemsCountPerRow()
    window.addEventListener("resize", calculateItemsCountPerRow)
})

onUnmounted(() => {
    window.removeEventListener("resize", calculateItemsCountPerRow)
})

const calculateItemsCountPerRow = () => {
    const el = artistListRef.value as HTMLDivElement

    const rect = el.getBoundingClientRect()

    const width = rect.width

    itemsCountPerRow.value = Math.max(Math.floor(width / 190), 1)
}

const rows = computed(() => {
    if (props.oneRow) {
        return [props.artists.slice(0, itemsCountPerRow.value)]
    }

    return _.chunk(props.artists, itemsCountPerRow.value)
})

const loadMoreArtistsHandler = () => {
    emit("load-more")
}
</script>

<template>
    <div
        class="artist-list"
        :class="[
            oneRow && 'one-row'
        ]"
        ref="artistListRef"
    >
        <div
            class="artist-list__title"
            v-if="title"
        >
            <h1 @click="clickOnTitleHandler">{{ title }}</h1>
        </div>
        <div class="artist-list__rows">

            <artist-list-row
                :items-count-per-row="itemsCountPerRow"
                v-if="oneRow"
            >
                <artist-media-card
                    :id="artist.id"
                    v-for="artist in rows[0]"
                    :key="artist.id"
                />
            </artist-list-row>

            <template v-else>
                <i-infinite-scroll
                    :has-more="hasMore"
                    @load-more="loadMoreArtistsHandler"
                >
                    <i-virtual-scroll
                        :count="rows.length"
                        :estimate-size="270"
                        :gap="20"
                        window
                    >
                        <template #item="{ virtualRow }">
                            <artist-list-row :items-count-per-row="itemsCountPerRow">
                                <artist-media-card
                                    :id="artist.id"
                                    v-for="artist in rows[virtualRow.index]"
                                    :key="artist.id"
                                />
                            </artist-list-row>
                        </template>
                    </i-virtual-scroll>
                </i-infinite-scroll>
            </template>

        </div>
    </div>
</template>

<style lang="scss">
.artist-list {
    display: flex;
    flex-direction: column;
    gap: 8px;

    width: calc(100vw - 48px);

    &.one-row {
        overflow: hidden;
    }

    &__title {
        display: flex;
        user-select: none;

        & > h1 {
            font-size: 20px;
            line-height: 32px;
            font-weight: 600;
            cursor: pointer;
            margin: 0;

            &:hover {
                text-decoration: underline;
            }
        }
    }

    &__rows {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
}
</style>
