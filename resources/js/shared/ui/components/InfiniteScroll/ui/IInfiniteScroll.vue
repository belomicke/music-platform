<script setup lang="ts">
import { shallowRef, useTemplateRef, watch } from "vue"
import { useIntersectionObserver } from "@vueuse/core"
import { IIcon } from "@/shared/ui"

defineProps<{
    hasMore: boolean
}>()

const emit = defineEmits(["load-more"])

const loader = useTemplateRef<HTMLDivElement>("loader")
const loaderIsVisible = shallowRef(false)

useIntersectionObserver(
    loader,
    ([entry]) => {
        loaderIsVisible.value = entry?.isIntersecting || false
    },
)

watch(loaderIsVisible, () => {
    if (loaderIsVisible.value) {
        emit("load-more")
    }
})
</script>

<template>
    <div class="i-infinite-scroll">
        <slot></slot>
        <div
            class="i-infinite-scroll__loader"
            ref="loader"
            v-if="hasMore"
        >
            <i-icon
                icon="loader"
            />
        </div>
    </div>
</template>

<style lang="scss">
.i-infinite-scroll {
    &__loader {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;

        & > svg {
            animation: rotate infinite linear 1s;
        }
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
