<script setup lang="ts">
import { type IconName, IIcon, type UiSize } from "@/shared/ui"

withDefaults(defineProps<{
    icon: IconName,
    size?: UiSize
    active?: boolean
    filled?: boolean
    disabled?: boolean
}>(), {
    size: "s",
    active: false,
    filled: false,
    disabled: false,
})
</script>

<template>
    <button
        class="i-icon-button"
        :class="[
            active && 'active'
        ]"
        :disabled="disabled"
        v-bind="$attrs"
    >
        <i-icon
            :icon="icon"
            :size="size"
            :filled="filled"
        />
    </button>
</template>

<style lang="scss">
.i-icon-button {
    --text-enabled-color: var(--ym-controls-color-primary-text-enabled);
    --text-hovered-color: var(--ym-controls-color-primary-text-enabled_variant);

    display: flex;
    justify-content: center;
    align-items: center;

    border-radius: 50%;
    background: none;
    border: none;
    outline: none;
    padding: 0;
    cursor: pointer;

    color: var(--text-enabled-color);

    &:disabled {
        cursor: default;
        opacity: .5;
    }

    &:hover:not(:disabled), &.active {
        color: var(--text-hovered-color);
    }

    & > svg {
        transition: color .3s;
    }
}
</style>
