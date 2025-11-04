<script setup lang="ts">
import { onMounted, onUnmounted, useTemplateRef } from "vue"

const rowRef = useTemplateRef("rowRef")

const itemsCountPerRow = defineModel<number | undefined>("items-per-row", {
    default: undefined,
})

onMounted(() => {
    calculateItemsCountPerRow()
    window.addEventListener("resize", calculateItemsCountPerRow)
})

onUnmounted(() => {
    window.removeEventListener("resize", calculateItemsCountPerRow)
})

const calculateItemsCountPerRow = () => {
    const el = rowRef.value as HTMLDivElement

    if (!el) return 2

    const rect = el.getBoundingClientRect()

    const width = rect.width - 48

    if (width >= 1206) {
        itemsCountPerRow.value = 6
        return
    } else if (width >= 1010) {
        itemsCountPerRow.value = 5
        return
    } else if (width >= 768) {
        itemsCountPerRow.value = 4
        return
    } else if (width >= 540) {
        itemsCountPerRow.value = 3
        return
    } else {
        itemsCountPerRow.value = 2
        return
    }
}
</script>

<template>
    <div
        class="media-row"
        ref="rowRef"
    >
        <slot></slot>
    </div>
</template>

<style lang="scss">
.media-row {
    display: flex;
    flex-direction: column;
    gap: calc(var(--ym-spacer-size-m) * 2);

    padding-inline: var(--ym-spacer-size-xxl);

    container-name: media-list-container;
    container-type: inline-size;
}
</style>
