<script setup lang="ts">
withDefaults(defineProps<{
    itemsCountPerRow: number
}>(), {
    itemsCountPerRow: 9,
})
</script>

<template>
    <div
        class="artist-list-row"
        :style="{
            'grid-template-columns': `repeat(${itemsCountPerRow}, 190px)`
        }"
    >
        <slot></slot>
    </div>
</template>

<style lang="scss">
.artist-list-row {
    display: grid;
    justify-content: space-between;
    width: 100%;
    height: 270px;
}
</style>
