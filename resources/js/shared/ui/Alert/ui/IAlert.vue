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
        color: #67c23a;
        background-color: rgb(28.3, 37.4, 23.8);
        border: 1px solid rgb(61.5, 107, 39);
    }

    &.info {
        color: #909399;
        background-color: rgb(32.4, 32.7, 33.3);
        border: 1px solid rgb(82, 83.5, 86.5);
    }

    &.warning {
        color: #e6a23c;
        background-color: rgb(41, 34.2, 24);
        border: 1px solid rgb(125, 91, 40);
    }

    &.error {
        color: #f56c6c;
        background-color: rgb(42.5, 28.8, 28.8);
        border: 1px solid rgb(132.5, 64, 64);
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
