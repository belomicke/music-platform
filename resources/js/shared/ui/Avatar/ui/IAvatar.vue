<script setup lang="ts">
import { IconName, IIcon } from "@/shared/ui"

const props = withDefaults(defineProps<{
    url?: string
    size?: number
    clickable?: boolean
    icon?: IconName
}>(), {
    size: 36,
    url: "",
    clickable: false,
    icon: "app-logo",
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
        <i-icon
            class="i-avatar__icon"
            :icon="icon"
        />
    </div>
</template>

<style lang="scss">
.i-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgb(20, 20, 20);
    border-radius: 50%;
    user-select: none;

    background-size: cover;
    background-position: center center;

    font-size: 16px;
    font-weight: 800;
    
    aspect-ratio: 1 / 1;

    &.clickable {
        cursor: pointer;
    }

    &__icon {
        width: 60%;
        height: 60%;
        color: var(--color-text-secondary);
    }
}
</style>
