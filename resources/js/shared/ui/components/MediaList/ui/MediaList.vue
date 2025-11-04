<script setup lang="ts">
import { computed, ref } from "vue"
import _ from "lodash"
import MediaListRow from "./MediaListRow.vue"
import MediaRow from "./MediaRow.vue"
import { IInfiniteVirtualScroll } from "@/shared/ui"

const props = defineProps<{
    items: string[]
    hasMore: boolean
    oneRow: boolean
}>()

const emit = defineEmits([
    "load-more",
])

const itemsCountPerRow = ref<number | undefined>(undefined)

const rows = computed(() => {
    return _.chunk(props.items, itemsCountPerRow.value)
})

const loadMoreHandler = () => {
    emit("load-more")
}
</script>

<template>
    <media-row v-model:items-per-row="itemsCountPerRow">
        <media-list-row
            v-if="oneRow"
        >
            <slot
                name="item"
                :item="item"
                v-for="item in items.slice(0, itemsCountPerRow)"
                :key="item"
            />
        </media-list-row>
        <i-infinite-virtual-scroll
            :has-more="hasMore"
            :count="rows.length"
            @load-more="loadMoreHandler"
            v-else
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
        </i-infinite-virtual-scroll>
    </media-row>
</template>
