<script setup lang="ts">
import { IInfiniteScroll, IVirtualScroll } from "@/shared/ui"

defineProps<{
    count: number
    hasMore: boolean
}>()

const emit = defineEmits(["load-more"])

const loadMoreHandler = () => {
    emit("load-more")
}
</script>

<template>
    <i-infinite-scroll
        :has-more="hasMore"
        @load-more="loadMoreHandler"
    >
        <i-virtual-scroll
            :count="count"
            :estimate-size="248"
            :gap="20"
            window
        >
            <template #item="{ virtualRow }">
                <slot
                    name="item"
                    :virtual-row="virtualRow"
                />
            </template>
        </i-virtual-scroll>
    </i-infinite-scroll>
</template>

<style scoped lang="scss">

</style>
