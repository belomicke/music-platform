<script setup lang="ts">
import { type IconName, IIcon } from "@/shared/ui"

export type IconButtonVariants = "primary" | "ghost" | "outline" | "transparent"

withDefaults(defineProps<{
    icon: IconName,
    filled?: boolean
    size?: number
    variant?: IconButtonVariants
    disabled?: boolean
    iconSize?: number
}>(), {
    size: 40,
    variant: "ghost",
    filled: false,
    disabled: false,
    iconSize: 20,
})
</script>

<template>
    <button
        class="i-icon-button"
        :class="[
            variant,
            disabled
        ]"
        :style="{
            'width': `${size}px`,
            'height': `${size}px`,
        }"
        :disabled="disabled"
    >
        <i-icon
            :icon="icon"
            :size="iconSize"
            :filled="filled"
        />
    </button>
</template>

<style lang="scss">
.i-icon-button {
    display: flex;
    justify-content: center;
    align-items: center;

    border-radius: 50%;
    padding: 0;

    cursor: pointer;

    border: none;
    outline: none;

    transition: background-color .15s;

    &:disabled {
        cursor: default;
        opacity: .5;
    }

    &.primary {
        background-color: rgba(26, 26, 26, 0.9);

        &:hover:not(:disabled) {
            background-color: rgba(51, 51, 51, .9);
        }
    }

    &.ghost {
        color: var(--color-text-primary);
        background-color: rgba(var(--color-text-primary-rgb), 0.08);

        &:hover:not(:disabled) {
            background-color: rgba(var(--color-text-primary-rgb), 0.12);
        }
    }

    &.outline {
        color: var(--color-text-primary);
        background-color: transparent;
        border: 2px solid var(--color-border-lighter);
        transition: border-color .15s;

        &:hover:not(:disabled) {
            border-color: var(--color-border-lighter-hover);
        }
    }

    &.transparent {
        padding: 0;
        color: rgba(255, 255, 255, .5);
        background-color: transparent;
        transition: color .15s;

        &:hover:not(:disabled) {
            color: rgb(230, 230, 230);
        }
    }
}
</style>
