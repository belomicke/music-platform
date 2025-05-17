<script setup lang="ts">
import { computed, useSlots } from "vue"
import { useResponsive } from "@/shared/hooks"

const props = defineProps<{
    title: string
    type: string
}>()

const slots = useSlots()

const { deviceType } = useResponsive()

const titleLength = computed(() => {
    if (deviceType.value === "mobile") return "mobile"

    if (props.title.length > 32) return "long"
    else return "short"
})

const hasMeta = computed(() => {
    return slots["meta"]
})
</script>

<template>
    <div class="media-page-header">
        <slot name="avatar"/>
        <div class="media-page-header__content">
            <div class="media-page-header__info">
                <div
                    class="media-page-header__type"
                    v-if="deviceType !== 'mobile'"
                >
                    {{ type }}
                </div>
                <h1
                    class="media-page-header__title"
                    :class="[
                        titleLength
                    ]"
                >
                    {{ title }}
                </h1>
                <div
                    class="media-page-header__meta"
                    v-if="hasMeta"
                >
                    <slot name="meta"/>
                </div>
            </div>
            <div class="media-page-header__actions">
                <slot name="actions"/>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 20px 24px;

    container-name: media-page-header;

    @media only screen and (max-width: 1060px) {
        flex-direction: column;
        align-items: start;
    }

    @media only screen and (max-width: 768px) {
        align-items: center;
    }

    &__content {
        display: flex;
        flex-direction: column;
    }

    &__info {
        display: flex;
        flex-direction: column;
        margin-bottom: 32px;

        @media only screen and (max-width: 768px) {
            margin-bottom: 24px;
        }
    }

    &__meta {
        display: flex;
        gap: 8px;
        margin-top: 8px;

        @media only screen and (max-width: 768px) {
            justify-content: center;
            margin-top: 20px;
        }
    }

    &__actions {
        display: flex;
        gap: 12px;

        @media only screen and (max-width: 768px) {
            justify-content: center;
        }
    }

    &__type {
        color: var(--color-text-secondary);
        font-size: 14px;
        line-height: 20px;
        font-weight: 500;
    }

    &__title {
        margin: 0;

        &.short {
            font-size: 48px;
            line-height: 48px;
        }

        &.long {
            font-size: 26px;
            line-height: 28px;
        }

        &.mobile {
            font-size: 24px;
            line-height: 26px;
            font-weight: 700;
            font-style: normal;
        }
    }

    &__subtitle {
        font-size: 16px;
        line-height: 2;
    }
}
</style>
