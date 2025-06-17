<script setup lang="ts">
import { computed } from "vue"
import AppSidebar from "./ui/AppSidebar/AppSidebar.vue"
import { AppPlayer } from "@/widgets/player"
import { StickyHeaderWithNavigation } from "@/shared/ui"
import { useResponsive } from "@/shared/hooks"

const { windowSize } = useResponsive()

const width = computed(() => windowSize.value.width)
</script>

<template>
    <div class="app-layout">
        <app-sidebar
            v-if="width.value > 1080"
        />
        <div class="main">
            <div class="main__content">
                <app-sidebar
                    v-if="width.value <= 1080 && width.value >= 768"
                />
                <div class="app-layout-content__wrapper">
                    <div class="app-layout-content">
                        <sticky-header-with-navigation
                            scroll-element-query-selector=".app-layout-content"
                        />
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <app-player
            />
        </div>
    </div>
</template>

<style lang="scss">
.app-layout {
    --app-padding: 10px;
    --sidebar-width: 320px;
    --sidebar-width-compact: 72px;
    --app-player-height: 80px;

    display: grid;
    grid-template-columns: var(--sidebar-width) 1fr;
    gap: 12px;
    padding: var(--app-padding);
    height: 100vh;

    @media (max-width: 1080px) {
        display: flex;
        border: none;
        border-radius: 0;
    }

    @media (max-width: 767px) {
        padding: 0;
    }

    &-body {
        display: grid;
        grid-template-rows: 1fr var(--app-player-height);
        gap: 12px;
    }

    &-content {
        height: 100%;
        overflow-y: scroll;

        &__wrapper {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            border: 1px solid var(--color-border);
            background-color: var(--color-background);
            overflow: hidden;

            @media (max-width: 767px) {
                border: none;
                border-radius: 0;
            }
        }

        @media (max-width: 767px) {
            height: calc(100vh - 80px);
        }
    }
}

.main {
    display: grid;
    grid-template-rows: 1fr 80px;
    gap: 12px;
    width: 100%;

    @media (max-width: 1080px) {
        padding-bottom: 12px;
    }

    @media (max-width: 767px) {
        display: grid;
        grid-template-rows: 1fr 80px;
        padding: 0;
        gap: 0;
    }

    &__content {
        height: calc(100vh - var(--app-player-height) - var(--app-padding) * 2 - 12px);
        width: calc(100vw - var(--sidebar-width) - var(--app-padding) * 2 - 12px);

        @media (max-width: 1080px) {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            gap: 12px;
            width: 100%;
        }

        @media (max-width: 1024px) {
            grid-template-columns: var(--sidebar-width-compact) 1fr;
        }

        @media (max-width: 767px) {
            display: flex;
            padding: 0;
            width: 100vw;
            height: calc(100vh - var(--app-player-height));
        }
    }
}

.footer {
    height: 80px;
    padding: 0 12px;
}
</style>
