<script setup lang="ts">
import { computed, getCurrentInstance } from "vue"
import { IIcon } from "@/shared/ui"

defineProps<{
    title?: string
}>()

defineEmits(["click-on-logo"])

const logoIsClickable = computed(() => {
    return getCurrentInstance()?.vnode.props?.["onClickOnLogo"]
})
</script>

<template>
    <form class="i-form-container">
        <div class="i-form-container-header">
            <i-icon
                class="i-form-container-header__logo"
                :class="[
                    logoIsClickable && 'clickable'
                ]"
                @click="$emit('click-on-logo')"
                icon="app-logo"
                :size="36"
            />
            <div class="i-form-container-header__titles">
                <h2
                    class="i-form-container-header__title"
                    v-if="title"
                >
                    {{ title }}
                </h2>
            </div>
        </div>
        <div class="i-form-container-content">
            <slot></slot>
        </div>
    </form>
</template>

<style lang="scss">
.i-form-container {
    display: flex;
    flex-direction: column;
    gap: 32px;

    &-header {
        display: flex;
        flex-direction: column;
        gap: 16px;

        &__logo {
            margin: 0 auto;

            &.clickable {
                cursor: pointer;
            }
        }

        &__titles {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        & h2 {
            font-size: 22px;
            line-height: 32px;
            font-weight: 500;
            color: var(--color-text-primary);
            margin: 0;
            text-align: center;
        }
    }

    &-content {
        display: flex;
        flex-direction: column;
    }
}
</style>
