<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { Dialog } from "../types"
import { IButton } from "@/shared/ui"

defineProps<{
    dialog: Dialog
}>()

const { t } = useI18n()

const emit = defineEmits([
    "close",
    "submit",
])

const submitHandler = () => {
    emit("submit")
}

const closeHandler = () => {
    emit("close")
}
</script>

<template>
    <div class="i-dialog">
        <div
            class="i-dialog__background"
            @click="closeHandler"
        />
        <div class="i-dialog__container">
            <div class="i-dialog__header">
                <div class="i-dialog__title">{{ dialog.title }}</div>
            </div>
            <div class="i-dialog__content">
                <p>{{ dialog.message }}</p>
                <div class="i-dialog__buttons">
                    <i-button
                        text
                        @click="submitHandler"
                    >
                        {{ dialog.confirmButtonText }}
                    </i-button>
                    <i-button
                        text
                        variant="danger"
                        @click="closeHandler"
                    >
                        {{ t("ui.dialog.action.cancel") }}
                    </i-button>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.i-dialog {
    display: flex;
    justify-content: center;
    align-items: center;

    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: var(--z-index-dialog);

    &__background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--overlay-background-color);
    }

    &__container {
        display: inline-flex;
        flex-direction: column;
        min-width: 384px;
        background-color: var(--color-background-secondary);
        z-index: var(--z-index-dialog);
        border-radius: 1rem;
        user-select: none;
    }

    &__header {
        padding: 1.3125rem 1.375rem 0;
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    &__title {
        font-size: 1.25rem;
        font-weight: 500;
        flex: 1 1 auto;
        text-overflow: ellipsis;
    }

    &__content {
        width: 100%;
        flex-grow: 1;
        padding: 1rem 1.5rem 1.1875rem;
        overflow-y: auto;
        max-height: 92vh;

        & > p {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 1rem;
        }
    }

    &__buttons {
        display: flex;
        justify-content: end;
        flex-wrap: wrap;
        gap: .5rem;

        & button {
            text-transform: uppercase;
        }
    }
}
</style>
