<script setup lang="ts">
import AppSidebarFooter from "./AppSidebarFooter/AppSidebarFooter.vue"
import AppSidebarNavigation from "./AppSidebarNavigation.vue"
</script>

<template>
    <div class="app-sidebar">
        <app-sidebar-navigation/>
        <app-sidebar-footer/>
    </div>
</template>

<style lang="scss">
.app-sidebar {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    width: var(--sidebar-width);

    @media (max-width: 1024px) {
        width: var(--sidebar-width-compact);
    }
}
</style>
