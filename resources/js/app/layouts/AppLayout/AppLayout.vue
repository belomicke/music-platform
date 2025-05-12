<script setup lang="ts">
import AppSidebar from "./ui/AppSidebar/AppSidebar.vue"
import AppLayoutStickyHeader from "./ui/AppLayoutStickyHeader.vue"
import { useResponsive } from "@/shared/hooks"

const { deviceType } = useResponsive()
</script>

<template>
    <div class="app-layout">
        <app-sidebar
            v-if="deviceType !== 'mobile'"
        />

        <div class="app-layout-content__wrapper">
            <div class="app-layout-content">
                <app-layout-sticky-header/>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.app-layout {
    --app-padding: 10px;
    --sidebar-width: 320px;
    --sidebar-width-compact: 72px;

    display: grid;
    grid-template-columns: var(--sidebar-width) 1fr;
    gap: 12px;

    height: 100vh;
    padding: var(--app-padding);

    @media (max-width: 1024px) {
        grid-template-columns: var(--sidebar-width-compact) 1fr;
    }

    @media (max-width: 768px) {
        display: flex;
        padding: 0;
    }

    &-content {
        height: 100%;
        overflow-y: scroll;

        &__wrapper {
            width: 100%;
            border-radius: 12px;
            border: 1px solid var(--color-border);
            background-color: rgb(20, 20, 20);
            overflow: hidden;

            @media (max-width: 768px) {
                border: none;
                border-radius: 0;
            }
        }
    }
}
</style>
