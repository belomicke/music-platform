<script setup lang="ts">
import { computed, useSlots } from "vue"

const props = withDefaults(defineProps<{
    title: string
    subtitle?: string
    type: string
}>(), {
    subtitle: "",
})

const slots = useSlots()

const withSubtitle = computed(() => {
    return props.subtitle.length !== 0 || slots["subtitle"] !== undefined
})
</script>

<template>
    <div class="media-page-header">
        <slot name="avatar"/>
        <div class="media-page-header__info">
            <div class="media-page-header__type">{{ type }}</div>
            <h1 class="media-page-header__title">{{ title }}</h1>
            <div
                class="media-page-header__subtitle"
                v-if="withSubtitle"
            >
                <slot name="subtitle">
                    {{ subtitle }}
                </slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header {
    display: flex;
    align-items: center;
    gap: 32px;
    padding: 40px;
    position: relative;
    user-select: none;

    @media (max-width: 640px) {
        flex-direction: column;
    }

    &__info {
        display: flex;
        flex-direction: column;
        z-index: 1;
    }

    &__title {
        font-size: 6rem;
        line-height: 1;
        margin: 0;
    }

    &__subtitle {
        font-size: 16px;
        line-height: 2;
    }
}
</style>
