<script setup lang="ts">
import { shallowRef, useTemplateRef, watch } from "vue"
import { useIntersectionObserver } from "@vueuse/core"

defineProps<{
    hasMore: boolean
}>()

const emit = defineEmits(["load-more"])

const loader = useTemplateRef<HTMLDivElement>("loader")
const loaderIsVisible = shallowRef(false)

const { stop } = useIntersectionObserver(
    loader,
    ([entry], observerElement) => {
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
            loading...
        </div>
    </div>
</template>

<style lang="scss">

</style>
