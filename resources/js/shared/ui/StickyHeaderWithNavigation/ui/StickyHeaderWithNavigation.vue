<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { storeToRefs } from "pinia"
import { useStickyHeaderStore } from "../model"
import { IIconButton } from "@/shared/ui"

const props = defineProps<{
    scrollElementQuerySelector: string
}>()

const route = useRoute()
const router = useRouter()

const canGoBack = ref<boolean | undefined>(undefined)
const canGoForward = ref<boolean | undefined>(undefined)

const stickyHeaderStore = useStickyHeaderStore()
const { getTitle } = storeToRefs(stickyHeaderStore)

const title = computed(() => getTitle.value)

const scrollTop = ref<number>(0)

const scrollElement = computed<HTMLDivElement>(() => {
    return document.querySelector(props.scrollElementQuerySelector)
})

watch(route, () => {
    getHistoryState()
})

onMounted(() => {
    getHistoryState()

    scrollElement.value.addEventListener("scroll", onScrollHandler)
})

onUnmounted(() => {
    scrollElement.value.removeEventListener("scroll", onScrollHandler)
})

const onScrollHandler = () => {
    scrollTop.value = scrollElement.value.scrollTop
}

const getHistoryState = () => {
    const back = window.history.state.back
    const forward = window.history.state.forward

    if (back === undefined && forward === undefined) {
        canGoBack.value = false
        canGoForward.value = false
        return
    }

    canGoBack.value = back !== null && back !== undefined
    canGoForward.value = forward !== null && forward !== undefined
}

const goBackHandler = () => {
    router.back()
}

const goForwardHandler = () => {
    router.forward()
}

const scrollToTop = () => {
    scrollElement.value.scrollTo({
        top: 0,
        behavior: "smooth",
    })
}
</script>

<template>
    <div class="media-page-sticky-header">
        <div class="media-page-sticky-header__navigation">
            <i-icon-button
                icon="chevron-left"
                variant="ghost"
                :size="32"
                :disabled="!canGoBack"
                @click="goBackHandler"
            />
            <i-icon-button
                icon="chevron-right"
                variant="ghost"
                :size="32"
                :disabled="!canGoForward"
                @click="goForwardHandler"
            />
        </div>
        <div
            class="media-page-sticky-header__title"
            :class="[
                scrollTop > 100 && 'visible'
            ]"
            @click="scrollToTop"
            v-if="title.length > 0"
        >
            {{ title }}
        </div>
    </div>
</template>

<style lang="scss">
.media-page-sticky-header {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 0 24px;
    background-color: var(--color-background-transparent-8);
    backdrop-filter: blur(12px);
    height: 60px;
    position: sticky;
    top: 0;
    z-index: 1;

    &__navigation {
        display: flex;
        gap: 8px;
    }

    &__title {
        font-size: 18px;
        line-height: 1;
        font-weight: 600;
        opacity: 0;
        pointer-events: none;
        user-select: none;
        cursor: pointer;
        transition: opacity .15s, color .15s;

        &.visible {
            opacity: 1;
            pointer-events: all;
        }

        &:hover {
            color: var(--color-text-secondary);
        }
    }
}
</style>
