<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useStickyHeaderStore, useStickyHeaderTitle } from "@/widgets/app/app-sticky-header"
import { computed } from "vue"

const props = withDefaults(defineProps<{
    title?: string
}>(), {
    title: "",
})

const stickyHeaderStore = useStickyHeaderStore()
const { getIsMount } = storeToRefs(stickyHeaderStore)

useStickyHeaderTitle(computed(() => props.title))
</script>

<template>
    <teleport
        to="#app-sticky-header-content"
        v-if="getIsMount"
    >
        <slot></slot>
    </teleport>
</template>

<style lang="scss">

</style>
