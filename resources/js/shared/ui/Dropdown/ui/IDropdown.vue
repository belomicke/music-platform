<script setup lang="ts">
import { computed, CSSProperties, onMounted, onUnmounted, ref, useTemplateRef, watch } from "vue"

const props = withDefaults(defineProps<{
    positionY?: "top" | "bottom"
    positionX?: "left" | "right"
}>(), {
    positionX: "right",
    positionY: "bottom",
})

const model = defineModel<boolean>({
    default: false,
})

const triggerRef = useTemplateRef<HTMLDivElement>("triggerRef")
const contentRef = useTemplateRef<HTMLDivElement>("contentRef")

const x = ref<number | undefined>(undefined)
const y = ref<number | undefined>(undefined)

const styles = computed(() => {
    let result: CSSProperties = {}

    result.top = `${y.value}px`
    result.left = `${x.value}px`
    result.position = "absolute"

    if (props.positionX === "right") {
        result.transform = "translateX(-100%)"
    }

    return result
})

watch(model, () => calculateDropdownPosition())

onMounted(() => {
    window.addEventListener("resize", calculateDropdownPosition)
})

onUnmounted(() => {
    window.removeEventListener("resize", calculateDropdownPosition)
})

const calculateDropdownPosition = () => {
    const rect = triggerRef.value.getBoundingClientRect()

    if (props.positionY === "bottom") {
        y.value = rect.top + rect.height + 10
    }

    if (props.positionX === "right") {
        x.value = rect.right
    }
}

const clickOnTriggerHandler = () => {
    model.value = true
}

const clickOnBackgroundHandler = () => {
    model.value = false
}
</script>

<template>
    <div
        class="i-dropdown__trigger"
        @click="clickOnTriggerHandler"
        ref="triggerRef"
    >
        <slot name="trigger"></slot>
    </div>
    <teleport
        to="#portals"
        v-if="model"
    >
        <div class="i-dropdown__modal">
            <div
                class="i-dropdown__background"
                @click="clickOnBackgroundHandler"
            />
            <div
                class="i-dropdown__content"
                :style="styles"
                ref="contentRef"
            >
                <slot name="content">
                    hello
                </slot>
            </div>
        </div>
    </teleport>
</template>

<style lang="scss">
.i-dropdown {
    &__modal {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: var(--z-index-dropdown);
    }

    &__background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: var(--z-index-dropdown);
    }

    &__content {
        position: absolute;
        z-index: var(--z-index-dropdown);
    }
}
</style>
