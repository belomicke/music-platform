<script setup lang="ts">
import { ILoader } from "@/shared/ui"
</script>

<template>
    <div class="search-page-loader">
        <i-loader
            :size="32"
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
}
</style>
