<script setup lang="ts">
import { onMounted } from "vue"
import type { Alert } from "../types"

const props = defineProps<{
    alert: Alert
}>()

const emit = defineEmits(["close"])

onMounted(() => {
    setTimeout(() => {
        emit("close")
    }, props.alert.duration)
})
</script>

<template>
    <div
        class="i-alert"
        :class="[
            alert.type,
            alert.center && 'is-center'
        ]"
    >
        <div class="i-alert__content">
            <span class="i-alert__title">{{ alert.text }}</span>
        </div>
    </div>
</template>

<style lang="scss">
.i-alert {
    display: flex;
    align-items: center;
    width: 100%;
    border-radius: 6px;
    padding: 8px 16px;
    cursor: pointer;
    user-select: none;
    z-index: var(--z-index-alert);

    &.success {
        color: var(--color-success);
        background-color: var(--color-success-light-9);;
        border: 1px solid var(--color-success-light-5);
    }

    &.info {
        color: var(--color-info);
        background-color: var(--color-info-light-9);
        border: 1px solid var(--color-info-light-5);
    }

    &.warning {
        color: var(--color-warning);
        background-color: var(--color-warning-light-9);
        border: 1px solid var(--color-warning-light-5);
    }

    &.error {
        color: var(--color-danger);
        background-color: var(--color-danger-light-9);
        border: 1px solid var(--color-danger-light-5);
    }

    &.is-center {
        justify-content: center;
    }

    &__content {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    &__title {
        font-size: 16px;
        line-height: 24px;
    }
}
</style>
