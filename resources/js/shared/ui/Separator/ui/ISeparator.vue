<script setup lang="ts">
withDefaults(defineProps<{
    type: "vertical" | "horizontal"
}>(), {
    type: "vertical",
})
</script>

<template>
    <div
        class="i-separator"
        :class="[
            type
        ]"
    />
</template>

<style lang="scss">
.i-separator {
    background-color: var(--color-border);

    &.vertical {
        width: 1px;
        height: 100%;
    }

    &.horizontal {
        height: 1px;
        width: 100%;
    }
}
</style>
