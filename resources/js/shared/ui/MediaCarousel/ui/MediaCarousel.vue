<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref, useTemplateRef, watch } from "vue"
import { useResponsive } from "@/shared/hooks"
import { IIconButton } from "@/shared/ui"

const props = withDefaults(defineProps<{
    items: string[]
    title?: string
    clickableTitle?: boolean
}>(), {
    title: "",
    clickableTitle: false,
})

const ITEM_WIDTH = 200
const ITEMS_GAP = 16

const ONE_STEP_OF_SCROLL = 500
const SMOOTH_SCROLL_DURATION = 360

const emit = defineEmits(["click-on-title"])

const carouselScrollRef = useTemplateRef("carouselScrollRef")

const { deviceType } = useResponsive()

const scrollProgress = ref<number>(0)
const isScrolling = ref<boolean>(false)

watch(isScrolling, () => {
    if (!isScrolling.value) {
        return
    }

    setTimeout(() => {
        isScrolling.value = false
    }, SMOOTH_SCROLL_DURATION)
})

const scrollWidth = computed(() => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return 0

    return props.items.length * ITEM_WIDTH + (props.items.length - 1) * ITEMS_GAP - el.clientWidth
})

const canScrollToLeft = computed(() => {
    return scrollProgress.value > 0
})

const canScrollToRight = computed(() => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return

    return scrollProgress.value < scrollWidth.value
})

onMounted(() => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return

    el.addEventListener("scroll", setScrollProgress)
})

onUnmounted(() => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return

    el.removeEventListener("scroll", setScrollProgress)
})

const setScrollProgress = () => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return

    scrollProgress.value = Math.ceil(el.scrollLeft)
}

const scrollToRight = () => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return
    if (isScrolling.value) return

    isScrolling.value = true

    if (el.scrollLeft + ONE_STEP_OF_SCROLL >= scrollWidth.value) {
        el.scrollLeft = scrollWidth.value
        return
    }

    el.scrollLeft += ONE_STEP_OF_SCROLL
}

const scrollToLeft = () => {
    const el = carouselScrollRef.value as HTMLDivElement

    if (!el) return
    if (isScrolling.value) return

    isScrolling.value = true

    if (el.scrollLeft < ONE_STEP_OF_SCROLL) {
        el.scrollLeft = 0
        return
    }

    el.scrollLeft -= ONE_STEP_OF_SCROLL
}

const clickOnTitleHandler = () => {
    emit("click-on-title")
}
</script>

<template>
    <div class="media-carousel">
        <div
            class="media-carousel__header"
            v-if="title"
        >
            <h1
                class="media-carousel__title"
                :class="[
                    clickableTitle && 'clickable'
                ]"
                @click="clickOnTitleHandler"
            >
                {{ title }}
            </h1>
            <div
                class="media-carousel__controls"
                v-if="deviceType !== 'mobile'"
            >
                <i-icon-button
                    variant="outline"
                    icon="chevron-left"
                    :size="32"
                    @click="scrollToLeft"
                    :disabled="!canScrollToLeft"
                />
                <i-icon-button
                    variant="outline"
                    icon="chevron-right"
                    :size="32"
                    @click="scrollToRight"
                    :disabled="!canScrollToRight"
                />
            </div>
        </div>
        <div
            class="media-carousel__items"
            role="list"
            ref="carouselScrollRef"
        >
            <div
                class="media-carousel__item"
                v-for="item in items"
                :key="item"
            >
                <slot
                    name="item"
                    :item="item"
                />
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.media-carousel {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
    padding: 0 24px;
    overflow: hidden;

    &__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none;
    }

    &__controls {
        display: flex;
        gap: 16px;
        opacity: 0;
        transition: opacity .15s;

        .media-carousel:hover & {
            opacity: 1;
        }
    }

    &__title {
        font-size: 24px;
        line-height: 32px;
        font-weight: 600;
        margin: 0;

        &.clickable:hover {
            cursor: pointer;
            text-decoration: underline;
        }
    }

    &__items {
        display: flex;
        gap: 16px;

        overflow-x: scroll;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        scrollbar-width: none;
    }

    &__item {
        width: 200px;

        & > div {
            width: 200px;
        }
    }
}
</style>
