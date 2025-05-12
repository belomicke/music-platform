<script setup lang="ts">
import { InputTypeHTMLAttribute } from "vue"

interface IInputProps {
    id?: string
    type?: InputTypeHTMLAttribute
    placeholder?: string
    autocomplete?: string
    label?: string
    description?: string
}

defineProps<IInputProps>()

const model = defineModel<string>()
</script>

<template>
    <div class="i-input">
        <slot name="label">
            <label
                :for="id"
                v-if="label"
            >
                {{ label }}
            </label>
        </slot>
        <input
            class="i-input"
            :placeholder="placeholder"
            autocomplete="off"
            v-model="model"
            :id="id"
            :type="type"
        />
        <p v-if="description">{{ description }}</p>
    </div>
</template>

<style lang="scss">
.i-input {
    display: flex;
    flex-direction: column;
    gap: 8px;
    user-select: none;

    & + & {
        margin-top: 16px;
    }

    & label {
        font-weight: 500;
    }

    & input {
        width: 100%;
        padding: 4px 12px;

        height: 40px;

        color: var(--color-text);
        background-color: transparent;

        border: 1px solid var(--color-border);
        border-radius: 12px;

        font-size: 14px;
        line-height: 20px;

        outline: none;

        transition: border-color .15s;

        &:hover {
            border-color: var(--color-border-hover);
        }

        &:focus {
            border-color: var(--color-text);
        }
    }

    & p {
        margin: 0;

        color: var(--color-text-secondary);
    }
}
</style>
