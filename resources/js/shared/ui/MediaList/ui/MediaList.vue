<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, useTemplateRef } from "vue"
import _ from "lodash"
import { IInfiniteScroll, IVirtualScroll, MediaListRow } from "@/shared/ui"

const props = defineProps<{
    items: string[]
    hasMore: boolean
}>()

const emit = defineEmits(["load-more"])

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

    if (!el) return 2

    const rect = el.getBoundingClientRect()

    if (rect.width >= 1206) {
        itemsCountPerRow.value = 6
        return
    } else if (rect.width >= 1010) {
        itemsCountPerRow.value = 5
        return
    } else if (rect.width >= 768) {
        itemsCountPerRow.value = 4
        return
    } else if (rect.width >= 540) {
        itemsCountPerRow.value = 3
        return
    } else {
        itemsCountPerRow.value = 2
        return
    }
}

const rows = computed(() => {
    return _.chunk(props.items, itemsCountPerRow.value)
})

const loadMoreHandler = () => {
    emit("load-more")
}
</script>

<template>
    <div
        class="media-list"
        ref="artistListRef"
    >
        <div class="media-list__rows">
            <i-infinite-scroll
                :has-more="hasMore"
                @load-more="loadMoreHandler"
            >
                <i-virtual-scroll
                    :count="rows.length"
                    :estimate-size="270"
                    :gap="20"
                    window
                >
                    <template #item="{ virtualRow }">
                        <media-list-row>
                            <slot
                                name="item"
                                :item="item"
                                v-for="item in rows[virtualRow.index]"
                                :key="item"
                            />
                        </media-list-row>
                    </template>
                </i-virtual-scroll>
            </i-infinite-scroll>
        </div>
    </div>
</template>

<style lang="scss">
.media-list {
    display: flex;
    flex-direction: column;
    gap: 8px;

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
        gap: 24px;

        container-name: media-list-container;
        container-type: inline-size;
    }
}
</style>
