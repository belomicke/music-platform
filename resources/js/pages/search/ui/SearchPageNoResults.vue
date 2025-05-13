<script setup lang="ts">
import { IIcon } from "@/shared/ui"
</script>

<template>
    <div class="search-page-no-results">
        <i-icon
            class="search-page-no-results__icon"
            icon="search"
            :size="40"
        />
        <h3 class="search-page-no-results__title">Ничего не нашли</h3>
        <div class="search-page-no-results__subtitle">Попробуйте написать по-другому</div>
    </div>
</template>

<style lang="scss">
.search-page-no-results {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;

    &__icon {
        color: var(--color-text-secondary);
        margin-bottom: 32px;
    }

    &__title {
        font-size: 22px;
        line-height: 32px;
        font-weight: 700;
        margin: 0 0 8px;
    }

    &__subtitle {
        color: var(--color-text-secondary);
        font-size: 16px;
        line-height: 24px;
        margin: 0;
    }
}
</style>
