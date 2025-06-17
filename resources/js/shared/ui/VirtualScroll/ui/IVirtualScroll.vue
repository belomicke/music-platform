<script setup lang="ts">
import { computed, nextTick, ref } from "vue"
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
        estimateSize: () => props.estimateSize,
        overscan: 5,
    }
})

const rowVirtualizer = useVirtualizer(options)

const virtualRows = computed(() => rowVirtualizer.value.getVirtualItems())

const totalSize = computed(() => rowVirtualizer.value.getTotalSize())

const measureElement = (el: Element) => {
    nextTick(() => {
        if (!el) {
            return
        }

        rowVirtualizer.value.measureElement(el)

        return undefined
    })
}
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
                :style="{
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: '100%',
                    transform: `translateY(${
                        virtualRows[0] ? virtualRows[0]?.start - rowVirtualizer.options.scrollMargin : 0
                    }px)`,
                }"
            >
                <div
                    :data-index="virtualRow.index"
                    :ref="measureElement"
                    v-for="virtualRow in virtualRows"
                    :key="virtualRow.index"
                >
                    <slot
                        name="item"
                        :virtual-row="virtualRow"
                    />
                    <div
                        :style="{
                            'height': `${gap}px`
                        }"
                        v-if="virtualRow.index !== count - 1"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

</style>
