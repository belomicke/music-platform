<script setup lang="ts">
import { ref } from "vue"
import { IconName, IIcon, IModal } from "@/shared/ui"

const props = withDefaults(defineProps<{
    url?: string
    size?: string
    maxSize?: string
    clickable?: boolean
    icon?: IconName
    canBeOpenInModal?: boolean
    round?: boolean,
    withOverlay?: boolean
}>(), {
    size: "36px",
    maxSize: "100%",
    url: "",
    clickable: false,
    icon: "app-logo",
    canBeOpenInModal: false,
    round: false,
    withOverlay: false,
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
        class="i-avatar-container"
        :class="[
            round && 'round',
            withOverlay && 'with-overlay'
        ]"
        v-bind="$attrs"
    >
        <img
            class="i-avatar"
            :src="url"
            :class="[
                (clickable || canBeOpenInModal) && 'clickable',
                withOverlay && 'with-overlay'
            ]"
            :style="{
                'width': size,
            }"
            @click="clickHandler"
            alt="avatar"
            v-if="url"
        />
        <div
            class="i-avatar__icon-container"
            :style="{
                'width': size,
                'height': size
            }"
            v-if="icon && url.length === 0"
        >
            <i-icon
                class="i-avatar__icon"
                :icon="icon"

            />
        </div>
        <div class="overlay">
            <div class="overlay__actions top">
                <slot name="overlay-top"></slot>
            </div>
            <div class="overlay__actions bottom">
                <slot name="overlay-bottom"></slot>
            </div>
        </div>
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
.i-avatar-container {
    position: relative;
}

.i-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--color-background);
    background-size: cover;
    background-position: center center;
    aspect-ratio: 1 / 1;
    border-radius: 6px;
    width: 100%;

    &.clickable {
        cursor: pointer;
    }

    .i-avatar-container.round & {
        border-radius: 50%;
    }

    &__icon-container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: var(--color-background-hover);
        border-radius: 6px;
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

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 6px;
    pointer-events: none;
    transition: background-color .15s;

    .i-avatar-container.with-overlay:hover & {
        background-color: rgba(0, 0, 0, .5);
    }

    .i-avatar-container.round & {
        border-radius: 50%;
    }

    &__actions {
        position: absolute;
        left: 0;
        padding: 0 10px;
        width: 100%;

        & > * {
            pointer-events: all;
        }

        &.top {
            top: 0;
            opacity: 0;
            transition: top .15s, opacity .15s;

            .i-avatar-container:hover & {
                top: 10px;
                opacity: 1;
            }
        }

        &.bottom {
            display: flex;
            justify-content: space-between;
            bottom: 0;
            opacity: 0;
            transition: bottom .15s, opacity .15s;

            .i-avatar-container:hover & {
                bottom: 10px;
                opacity: 1;
            }
        }
    }
}
</style>
