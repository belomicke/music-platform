<script setup lang="ts">
import AppLayoutHeader from "./ui/AppLayoutHeader.vue"
</script>

<template>
    <div class="app-layout">
        <app-layout-header/>
        <div class="app-layout-body">
            <div class="app-layout-content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.app-layout {
    display: grid;
    grid-template-rows: 64px minmax(0, 1fr);
    height: 100%;

    &-body {
        display: flex;
        flex: 1;
        gap: 8px;
    }

    &-content {
        width: 100%;
        max-width: 100vw;
        overflow: auto;
    }
}
</style>
