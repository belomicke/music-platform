<script setup lang="ts">
import { type IconName, IIcon } from "@/shared/ui"
import { computed } from "vue"

type IconButtonSizes = "large" | "default"
type IconButtonVariants = "ghost" | "outline" | "grey"

const props = withDefaults(defineProps<{
    icon: IconName,
    filled?: boolean
    size?: IconButtonSizes
    variant?: IconButtonVariants
    disabled?: boolean
    iconSize?: number
}>(), {
    size: "default",
    variant: "ghost",
    filled: false,
    disabled: false,
    iconSize: 20,
})

const iconSize = computed(() => {
    if (props.iconSize !== 20) return props.iconSize

    switch (props.size) {
        case "large":
            return 20
        case "default":
            return 20
    }
})
</script>

<template>
    <button
        class="i-icon-button"
        :class="[
            size,
            variant,
            disabled
        ]"
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

    cursor: pointer;

    border: none;
    outline: none;

    transition: background-color .15s;

    &:disabled {
        cursor: default;
        opacity: .5;
    }

    &.ghost {
        color: var(--color-text);
        background-color: rgba(255, 255, 255, 0.08);

        &:hover:not(:disabled) {
            background-color: rgba(255, 255, 255, 0.12);
        }
    }

    &.outline {
        color: var(--color-text);
        background-color: transparent;
        border: 2px solid #4d4d4d;
        transition: border-color .15s;

        &:hover:not(:disabled) {
            border-color: grey;
        }
    }

    &.grey {
        background-color: rgb(60, 60, 60);

        &:hover {
            background-color: rgba(80, 80, 80);
        }
    }

    &.large {
        width: 40px;
        height: 40px;
    }

    &.default {
        width: 32px;
        height: 32px;
    }
}
</style>
