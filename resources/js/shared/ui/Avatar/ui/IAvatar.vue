<script setup lang="ts">
import { IconName, IIcon, IModal } from "@/shared/ui"
import { ref } from "vue"

const props = withDefaults(defineProps<{
    url?: string
    size?: number
    clickable?: boolean
    icon?: IconName
    canBeOpenInModal?: boolean
}>(), {
    size: 36,
    url: "",
    clickable: false,
    icon: "app-logo",
    canBeOpenInModal: false,
})

const emit = defineEmits(["click"])

const modalIsOpen = ref<boolean>(false)

const clickHandler = (e: MouseEvent) => {
    if (props.canBeOpenInModal) {
        modalIsOpen.value = true
    }

    emit("click", e)
}
</script>

<template>
    <div
        class="i-avatar"
        :class="[
            (clickable || canBeOpenInModal) && 'clickable'
        ]"
        :style="{
            'width': `${size}px`,
            'height': `${size}px`,
            'background-image': `url(${props.url})`
        }"
        @click="clickHandler"
    >
        <i-icon
            class="i-avatar__icon"
            :icon="icon"
            v-if="icon && url.length === 0"
        />
    </div>

    <template v-if="canBeOpenInModal">
        <i-modal
            v-model:is-open="modalIsOpen"
        >
            <div
                class="i-avatar__modal"
                :style="{
                    'background-image': `url(${props.url})`
                }"
            />
        </i-modal>
    </template>
</template>

<style lang="scss">
.i-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgb(20, 20, 20);
    border-radius: 50%;
    user-select: none;

    background-size: cover;
    background-position: center center;

    font-size: 16px;
    font-weight: 800;

    aspect-ratio: 1 / 1;

    &.clickable {
        cursor: pointer;
    }

    &__icon {
        width: 60%;
        height: 60%;
        color: var(--color-text-secondary);
    }

    &__modal {
        background-size: cover;
        width: 640px;
        height: 640px;
    }
}
</style>
