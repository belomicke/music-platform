<script setup lang="ts">
import { IIcon } from "@/shared/ui"
</script>

<template>
    <div class="search-page-loader">
        <i-icon
            class="search-page-loader__icon"
            icon="loader"
            size="xl"
        />
    </div>
</template>

<style lang="scss">
.search-page-loader {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;

    &__icon {
        animation: rotate infinite linear 2s;
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
