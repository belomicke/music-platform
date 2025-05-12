<script setup lang="ts">
import { type IconName, IIcon } from "@/shared/ui"

interface IButtonProps {
    variant?: "primary" | "secondary" | "outline" | "ghost" | "link" | "danger"
    block?: boolean
    disabled?: boolean

    icon?: IconName
    iconSize?: number
    iconFilled?: boolean

    loading?: boolean
    round?: boolean
    text?: boolean
}

withDefaults(defineProps<IButtonProps>(), {
    variant: "primary",
    iconSize: 16,
    iconFilled: false,
})
</script>

<template>
    <button
        class="i-button"
        :class="[
            variant,
            text && 'text',
            block && 'block',
            round && 'round',
            icon !== undefined && 'icon'
        ]"
        :disabled="disabled || loading"
    >
        <i-icon
            class="i-button__loader"
            icon="loader"
            :size="16"
            v-if="loading"
        />
        <i-icon
            :icon="icon"
            :size="iconSize"
            :filled="iconFilled"
            v-if="icon"
        />
        <slot v-else></slot>
    </button>
</template>

<style lang="scss">
.i-button {
    display: inline-flex;
    justify-content: center;
    align-items: center;

    gap: 5px;

    cursor: pointer;

    font-size: 14px;
    line-height: 20px;
    font-weight: 500;

    outline: none;
    border: none;

    padding: 8px 16px;

    border-radius: 12px;

    height: 36px;

    user-select: none;

    transition: background-color .15s;

    &.block {
        width: 100%;
    }

    &.round {
        border-radius: 999px;
    }

    &.icon {
        padding: 10px;
        height: 40px;
        width: 40px;

        & > svg {
            width: 20px;
            height: 20px;
        }
    }

    &:disabled {
        cursor: default;
        opacity: .5;
    }

    &.primary {
        color: var(--color-background);
        background-color: var(--color-text-primary);

        &:hover:not(:disabled) {
            background-color: rgba(var(--color-text-primary-rgb), .7);
        }

        &.text {
            color: var(--color-text-primary);
        }
    }

    &.secondary {
        color: var(--color-text-primary);
        background-color: var(--color-border);

        &:hover:not(:disabled) {
            background-color: rgba(var(--color-border-rgb), .7);
        }
    }

    &.outline {
        color: var(--color-text-primary);
        background-color: transparent;
        border: 1px solid var(--color-border);

        &:hover:not(:disabled) {
            background-color: var(--color-border);
        }
    }

    &.ghost {
        color: var(--color-text-primary);
        background-color: rgba(255, 255, 255, 0.08);

        &:hover:not(:disabled) {
            background-color: rgba(255, 255, 255, 0.12);
        }
    }

    &.danger {
        color: var(--color-text-primary);
        background-color: #f56c6c;

        &:hover:not(:disabled) {
            background-color: #f56c6cb3;
        }

        &.text {
            color: #f56c6c;
        }
    }

    &.text {
        background-color: transparent;

        &:hover:not(:disabled) {
            background-color: rgba(var(--color-text-primary-rgb), .2);
        }
    }

    &.link {
        color: var(--color-text-primary);
        background-color: transparent;
        padding: 0;
        font-weight: 400;
        height: unset;

        &:hover:not(:disabled) {
            text-decoration: underline;
        }
    }

    &__loader {
        animation: rotate 1s infinite linear;
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(180deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
