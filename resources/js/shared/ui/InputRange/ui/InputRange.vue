<script setup lang="ts">
import { computed, ref, watch } from "vue"

const props = withDefaults(defineProps<{
    max: number
    step?: number
}>(), {
    step: 1,
})

const model = defineModel<number>()

const emit = defineEmits([
    "change",
    "input",
])

const value = ref<number>(model.value)

const mousedown = ref<boolean>(false)

watch(model, () => {
    if (mousedown.value) return

    value.value = model.value
})

const seekBeforeWidth = computed(() => {
    return value.value / props.max * 100
})

const mouseUpHandler = () => {
    mousedown.value = false
}

const mouseDownHandler = () => {
    mousedown.value = true
}

const inputHandler = (e: InputEvent) => {
    const el = e.target as HTMLInputElement

    value.value = Number(el.value)
    emit("input", value.value)
}

const changeHandler = (e: InputEvent) => {
    const el = e.target as HTMLInputElement

    value.value = Number(el.value)
    emit("change", value.value)
}

const scrollHandler = (e: WheelEvent) => {
    if (e.deltaY < 0) {
        const result = value.value + props.step

        if (result > props.max) {
            emit("input", props.max)
            return
        }

        emit("input", result)
    } else {
        const result = value.value - props.step

        if (result < 0) {
            emit("input", 0)
            return
        }

        emit("input", result)
    }
}
</script>

<template>
    <input
        class="i-input-range"

        :max="max"
        :value="value"
        :step="step"

        :style="{
            '--seek-before-width': `${seekBeforeWidth}%`
        }"
        type="range"

        @input="inputHandler"
        @change="changeHandler"

        @mousedown="mouseDownHandler"
        @mouseup="mouseUpHandler"

        @wheel="scrollHandler"
    />
</template>

<style scoped lang="scss">
.i-input-range {
    -webkit-appearance: none;
    appearance: none;
    background: transparent;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    height: .75rem;
    outline: none;
    position: relative;
    margin: 0;

    --seek-before-width: 0%;

    &::-webkit-slider-runnable-track {
        border-radius: 8px;
        background: linear-gradient(90deg, rgba(255, 255, 255, .16) var(--seek-before-width), rgba(255, 255, 255, .08) var(--seek-before-width));
        cursor: pointer;
        width: 100%;
        height: .25rem
    }

    &::before {
        content: "";
        height: .25rem;
        border-radius: 8px;
        background-color: rgb(230, 230, 230);
        width: var(--seek-before-width);
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        inset-block-start: 50%;
        inset-inline-start: 0;
    }

    &::-webkit-slider-thumb {
        appearance: none;
        -webkit-appearance: none;

        background-color: rgb(230, 230, 230);

        border-radius: 50%;
        box-shadow: none;

        position: relative;
        top: 50%;
        transform: translateY(-50%);

        height: 0;
        width: 0;
        border: none;

        inset-block-start: 50%;
    }
}

.i-input-range:hover::-webkit-slider-thumb {
    height: 20px;
    width: 20px;
    border: 4px solid var(--color-background);
}
</style>
