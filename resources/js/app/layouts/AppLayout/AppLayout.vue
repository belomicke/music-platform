<script setup lang="ts">
import { computed } from "vue"
import { AppStickyHeader } from "@/widgets/app/app-sticky-header"
import { AppSidebar } from "@/widgets/app/app-sidebar"
import { AppPlayer } from "@/widgets/app/app-player"
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
                    <main class="app-layout-content">
                        <app-sticky-header/>
                        <div class="app-layout-page">
                            <router-view></router-view>
                        </div>
                    </main>
                </div>
            </div>
            <app-player/>
        </div>
    </div>
</template>

<style lang="scss">
.app-layout {
    --app-padding: 10px;
    --navbar-width: 270px;
    --navbar-width-compact: 72px;
    --app-player-height: 80px;

    display: grid;
    grid-template-columns: var(--navbar-width) 1fr;
    column-gap: var(--ym-spacer-size-m);

    padding-block-end: var(--ym-spacer-size-m);
    padding-block-start: var(--ym-spacer-size-m);
    padding-inline-end: var(--ym-spacer-size-m);
    padding-inline-start: var(--ym-spacer-size-xs);

    height: 100vh;
    width: 100%;
    margin: 0 auto;

    &-body {
        display: grid;
        grid-template-rows: 1fr var(--app-player-height);
        gap: 12px;
    }

    &-content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        position: relative;
        background-color: var(--ym-background-color-primary-enabled-content);
        border: .0625rem solid var(--ym-outline-color-primary-disabled);
        border-radius: var(--ym-radius-size-xl);

        height: 100%;
        overflow-y: scroll;

        &__wrapper {
            display: flex;

            width: 100%;
            height: 100%;
            flex-grow: 1;
            position: relative;
            border-radius: var(--ym-radius-size-xl);
            overflow: hidden;
        }
    }

    &-page {
        flex-grow: 1;
        position: relative;
        padding-top: var(--ym-spacer-size-l);
        padding-bottom: var(--ym-spacer-size-xxl);
    }
}

.main {
    display: grid;
    grid-template-rows: 1fr 80px;
    gap: 12px;
    width: 100%;

    &__content {
        height: calc(100vh - var(--app-player-height) - var(--ym-spacer-size-m) * 2 - 12px);
        width: auto;
    }
}

.footer {
    height: 80px;
    padding: 0 12px;
}
</style>
