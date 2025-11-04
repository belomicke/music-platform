<script setup lang="ts"></script>

<template>
    <div class="collection-empty-page">
        <p class="collection-empty-page__note">Добавьте что-либо в свою коллекцию и оно отобразится здесь.</p>
    </div>
</template>

<style lang="scss">
.collection-empty-page {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    flex-grow: 1;
    height: 100%;

    &__note {
        font-size: var(--ym-font-size-label-l);
        font-weight: var(--ym-font-weight-medium);
        color: var(--ym-controls-color-primary-text-enabled);
        margin: 0;
    }
}
</style>
