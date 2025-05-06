<script setup lang="ts">
withDefaults(defineProps<{
    itemsCountPerRow: number
}>(), {
    itemsCountPerRow: 9,
})
</script>

<template>
    <div
        class="media-list-row"
        :style="{
            'grid-template-columns': `repeat(${itemsCountPerRow}, 190px)`
        }"
    >
        <slot></slot>
    </div>
</template>

<style lang="scss">
.media-list-row {
    display: grid;
    justify-content: space-between;
    width: 100%;
    height: 270px;
}
</style>
