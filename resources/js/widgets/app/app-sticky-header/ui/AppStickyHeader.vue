<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from "vue"
import { storeToRefs } from "pinia"
import { useRouterHistory } from "../lib"
import { useStickyHeaderStore } from "../model"
import { IButton } from "@/shared/ui"

const {
    canGoBack,
    canGoForward,
    goBack,
    goForward,
} = useRouterHistory()

const stickyHeaderStore = useStickyHeaderStore()
const { getTitle } = storeToRefs(stickyHeaderStore)

const title = computed(() => getTitle.value)

const scrollTop = ref<number>(0)

const scrollElement = computed<HTMLDivElement>(() => {
    return document.querySelector(".app-layout-content")
})

onMounted(() => {
    if (!scrollElement.value) return

    scrollElement.value.addEventListener("scroll", onScrollHandler)

    stickyHeaderStore.setIsMount(true)
})

onUnmounted(() => {
    if (!scrollElement.value) return

    scrollElement.value.removeEventListener("scroll", onScrollHandler)
})

const onScrollHandler = () => {
    scrollTop.value = scrollElement.value.scrollTop
}

const scrollToTop = () => {
    scrollElement.value.scrollTo({
        top: 0,
        behavior: "smooth",
    })
}
</script>

<template>
    <header class="app-sticky-header">
        <div
            class="app-sticky-header__blur"
            :class="[
                scrollTop > 100 && 'visible'
            ]"
        />
        <div class="app-sticky-header__left-block">
            <div class="app-sticky-header__navigation">
                <i-button
                    icon="chevron-left"
                    variant="secondary"
                    icon-button
                    round
                    :disabled="!canGoBack"
                    padding-size="xxs"
                    @click="goBack"
                />
                <i-button
                    icon="chevron-right"
                    variant="secondary"
                    icon-button
                    round
                    :disabled="!canGoForward"
                    padding-size="xxs"
                    @click="goForward"
                />
            </div>
            <div
                class="app-sticky-header__content"
                id="app-sticky-header-content"
            >
                <div
                    class="app-sticky-header__title"
                    @click="scrollToTop"
                >
                    {{ title }}
                </div>
            </div>
        </div>
    </header>
</template>

<style lang="scss">
.app-sticky-header {
    display: flex;
    align-items: center;
    gap: 24px;

    padding-block-end: var(--ym-spacer-size-m);
    padding-block-start: var(--ym-spacer-size-m);
    padding-inline-end: var(--ym-spacer-size-xxl);
    padding-inline-start: var(--ym-spacer-size-xxl);

    height: var(--header-height);

    width: 100%;
    position: sticky;
    inset-block-start: 0;
    inset-inline-end: 0;
    inset-inline-start: 0;

    background-color: transparent;
    backdrop-filter: blur(12px);

    z-index: var(--ym-z-index-header);
    transition: transform .25s;

    &__blur {
        backdrop-filter: blur(.5rem) brightness(100%) saturate(140%);
        background: linear-gradient(180deg, var(--ym-background-color-primary-enabled-content), transparent 50%);
        mask-image: linear-gradient(180deg, #000 0 50%, transparent 50% 100%);
        position: absolute;
        inset: 0;
        width: 100%;
        height: 200%;
        pointer-events: none;
        opacity: 0;
        transition: opacity var(--ym-duration-transition) ease;

        &.visible {
            opacity: 1;
        }
    }

    &__left-block {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: var(--ym-spacer-size-l);
        width: 100%;
        overflow: visible;
        z-index: 1;
    }

    &__navigation {
        display: flex;
        gap: 8px;
    }

    &__title {
        font-size: 24px;
        line-height: 1;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
        transition: opacity .15s, color .15s;

        &:hover {
            color: var(--color-primary-hover);
        }
    }

    &__content {
        display: flex;
        align-items: center;
        width: 100%;
    }
}
</style>
