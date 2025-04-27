<script setup lang="ts">
import { computed, ref } from "vue"
import { useVirtualizer } from "@tanstack/vue-virtual"

const props = withDefaults(defineProps<{
    count: number
    estimateSize?: number
    gap?: number
    window?: boolean
}>(), {
    estimateSize: 100,
    gap: 10,
    window: false,
})

const parentRef = ref<HTMLElement | null>(null)

const getScrollElement = () => {
    if (props.window) {
        return document.querySelector(".app-layout-content")
    } else {
        return parentRef.value
    }
}

const options = computed(() => {
    return {
        count: props.count,
        getScrollElement,
        estimateSize: () => props.estimateSize + props.gap,
        overscan: 5,
    }
})

const rowVirtualizer = useVirtualizer(options)

const virtualRows = computed(() => rowVirtualizer.value.getVirtualItems())

const totalSize = computed(() => rowVirtualizer.value.getTotalSize())
</script>

<template>
    <div
        ref="parentRef"
        class="i-infinite-scroll"
    >
        <div
            :style="{
                height: `${totalSize}px`,
                width: '100%',
                position: 'relative'
            }"
        >
            <div
                v-for="virtualRow in virtualRows"
                :key="virtualRow.index"
                :style="{
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: '100%',
                    height: `${virtualRow.size}px`,
                    transform: `translateY(${virtualRow.start}px)`,
                }"
            >
                <slot
                    name="item"
                    :virtual-row="virtualRow"
                />
            </div>
        </div>
    </div>
</template>

<style lang="scss">

</style>
