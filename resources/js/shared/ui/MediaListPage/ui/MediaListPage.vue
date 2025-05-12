<script setup lang="ts">
defineProps<{
    title: string
}>()
</script>

<template>
    <div class="media-list-page">
        <div class="media-list-page-header">
            <h1 class="media-list-page-header__title">
                {{ title }}
            </h1>
        </div>
        <div class="media-list-page-content">
            <slot></slot>
        </div>
    </div>
</template>

<style lang="scss">
.media-list-page {
    &-header {
        display: flex;
        align-items: center;

        position: sticky;
        top: 0;
        background-color: rgba(20, 20, 20, .8);
        backdrop-filter: blur(12px);
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
