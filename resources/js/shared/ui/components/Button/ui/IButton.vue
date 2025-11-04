<script setup lang="ts">
import { type IconName, IIcon, type UiSize } from "@/shared/ui"

export type IButtonVariants = "primary" |
    "secondary" |
    "outline" |
    "ghost" |
    "link" |
    "danger"

interface IButtonProps {
    variant?: IButtonVariants
    block?: boolean
    disabled?: boolean,

    paddingSize?: UiSize

    icon?: IconName
    iconButton?: boolean
    iconFilled?: boolean
    iconSize?: UiSize

    loading?: boolean
    round?: boolean
    text?: boolean
    noPadding?: boolean
}

withDefaults(defineProps<IButtonProps>(), {
    variant: "primary",

    iconSize: "xxs",

    iconFilled: false,
    noPadding: false,
    iconButton: false,
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
            iconButton && 'icon-button',
            noPadding && 'no-padding',
            iconSize,
            paddingSize && `padding-size-${paddingSize}`,
            icon !== undefined && 'icon',
        ]"
        :disabled="disabled || loading"
    >
        <i-icon
            class="i-button__loader"
            icon="loader"
            v-if="loading"
        />
        <i-icon
            :icon="icon"
            :filled="iconFilled"
            :size="iconSize"
            v-if="icon"
        />
        <slot></slot>
    </button>
</template>

<style lang="scss">
.i-button {
    display: inline-flex;
    justify-content: center;
    align-items: center;

    gap: var(--ym-spacer-size-xxxs);

    cursor: pointer;

    font-size: var(--ym-font-size-label-s);
    line-height: var(--ym-font-line-height-label-s);
    font-weight: var(--ym-font-weight-medium);

    outline: none;
    border: none;

    padding-inline-end: var(--ym-spacer-size-xl);
    padding-inline-start: var(--ym-spacer-size-xl);

    padding-block-end: var(--ym-spacer-size-s);
    padding-block-start: var(--ym-spacer-size-s);

    border-radius: 12px;

    transition: background-color .15s;

    &.icon-button {
        padding-block-end: var(--ym-spacer-size-s);
        padding-block-start: var(--ym-spacer-size-s);
        padding-inline-end: var(--ym-spacer-size-s);
        padding-inline-start: var(--ym-spacer-size-s);
    }

    &.padding-size-xxxs {
        padding: var(--ym-spacer-size-xxxs);
    }

    &.padding-size-xxs {
        padding: var(--ym-spacer-size-xxs);
    }

    &.padding-size-xs {
        padding: var(--ym-spacer-size-xs);
    }

    &.padding-size-s {
        padding: var(--ym-spacer-size-s);
    }

    &.padding-size-m {
        padding: var(--ym-spacer-size-m);
    }

    &.padding-size-l {
        padding: var(--ym-spacer-size-l);
    }

    &.padding-size-xl {
        padding: var(--ym-spacer-size-xl);
    }

    &.padding-size-xxl {
        padding: var(--ym-spacer-size-xxl);
    }

    &.padding-size-xxxl {
        padding: var(--ym-spacer-size-xxxl);
    }

    &.block {
        width: 100%;
    }

    &.round {
        border-radius: 999px;
    }

    &:disabled {
        cursor: default;
        opacity: .5;
    }

    &.no-padding {
        padding: 0 !important;
    }

    &.primary {
        color: var(--ym-controls-color-primary-on_default-enabled);
        background-color: var(--color-primary);

        &:hover:not(:disabled) {
            background-color: var(--ym-controls-color-primary-default-hovered);
        }

        &.text {
            color: var(--color-text-primary);
        }
    }

    &.secondary {
        background: var(--ym-controls-color-secondary-default-enabled);
        color: var(--ym-controls-color-secondary-on_default-enabled);

        &:hover:not(:disabled) {
            background-color: var(--ym-controls-color-secondary-default-hovered);
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
        color: var(--ym-controls-color-secondary-on_default-hovered);
        background-color: var(--ym-controls-color-secondary-card-enabled);

        &:hover:not(:disabled) {
            background-color: var(--ym-controls-color-secondary-card-hovered);
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
