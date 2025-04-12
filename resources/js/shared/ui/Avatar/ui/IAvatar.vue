<script setup lang="ts">
const props = withDefaults(defineProps<{
    url?: string
    size?: number
    clickable?: boolean
}>(), {
    size: 36,
    url: "",
    clickable: false,
})

</script>

<template>
    <div
        class="i-avatar"
        :class="[
            clickable && 'clickable'
        ]"
        :style="{
            'width': `${size}px`,
            'height': `${size}px`,
            'background-image': `url(${props.url})`
        }"
    >
        <slot></slot>
    </div>
</template>

<style lang="scss">
.i-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgb(40, 40, 40);
    border-radius: 50%;
    user-select: none;

    background-size: cover;
    background-position: center center;

    font-size: 16px;
    font-weight: 800;

    &.clickable {
        cursor: pointer;
    }
}
</style>
