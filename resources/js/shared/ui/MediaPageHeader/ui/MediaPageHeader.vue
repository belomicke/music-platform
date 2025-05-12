<script setup lang="ts">
defineProps<{
    title: string
    type: string
}>()
</script>

<template>
    <div class="media-page-header">
        <slot name="avatar"/>
        <div class="media-page-header__content">
            <div class="media-page-header__info">
                <div class="media-page-header__type">{{ type }}</div>
                <h1 class="media-page-header__title">{{ title }}</h1>
                <slot name="meta"/>
            </div>
            <slot name="actions"/>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 20px 24px;
    user-select: none;

    @media (max-width: 640px) {
        flex-direction: column;
    }

    &__content {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    &__info {
        display: flex;
        flex-direction: column;
        margin-bottom: 32px;
    }

    &__type {
        color: var(--color-text-secondary);
        font-size: 14px;
        line-height: 20px;
        font-weight: 500;
    }

    &__title {
        font-size: 48px;
        line-height: 48px;
        margin: 0;
    }

    &__subtitle {
        font-size: 16px;
        line-height: 2;
    }
}
</style>
