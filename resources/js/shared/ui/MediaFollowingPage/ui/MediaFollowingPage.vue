<script setup lang="ts">
defineProps<{
    title: string
}>()
</script>

<template>
    <div class="media-following-page">
        <div class="media-following-page-header">
            <h1 class="media-following-page-header__title">
                {{ title }}
            </h1>
        </div>
        <div class="media-following-page-content">
            <slot></slot>
        </div>
    </div>
</template>

<style lang="scss">
.media-following-page {
    &-header {
        position: sticky;
        top: 0;
        background-color: var(--color-background);
        z-index: 1;
        padding: 12px 24px;

        &__title {
            user-select: none;
        }
    }

    &-content {
        padding: 0 24px 24px;
    }
}
</style>
