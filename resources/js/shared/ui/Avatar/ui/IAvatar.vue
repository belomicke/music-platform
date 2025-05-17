<script setup lang="ts">
import { ref } from "vue"
import { IconName, IIcon, IModal } from "@/shared/ui"

const props = withDefaults(defineProps<{
    url?: string
    size?: number
    clickable?: boolean
    icon?: IconName
    canBeOpenInModal?: boolean
    round?: boolean,
    withOverlay?: boolean
}>(), {
    size: 36,
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
            round && 'round'
        ]"
    >
        <img
            class="i-avatar"
            :src="url"
            :class="[
                (clickable || canBeOpenInModal) && 'clickable',
                withOverlay && 'with-overlay'
            ]"
            :style="{
                'max-width': `${size}px`,
            }"
            @click="clickHandler"
        />
        <div class="i-avatar__icon-container">
            <i-icon
                class="i-avatar__icon"
                :icon="icon"
                v-if="icon && url.length === 0"
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
    border-radius: 6px;
    background-size: cover;
    background-position: center center;
    aspect-ratio: 1 / 1;
    width: 100%;

    &.clickable {
        cursor: pointer;
    }

    .i-avatar-container.round & {
        border-radius: 50%;
    }

    &.with-overlay {
        &::after {
            content: "";
            width: 100%;
            height: 100%;
            position: absolute;
            border-radius: 6px;
            top: 0;
            left: 0;
            transition: background-color .15s;

            .i-avatar-container.round & {
                border-radius: 50%;
            }

            .i-avatar-container:hover & {
                background-color: var(--overlay-background-color);
            }
        }
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
    pointer-events: none;

    &__actions {
        position: absolute;
        left: 0;
        padding: 0 10px;
        width: 100%;

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

    &__action {
        pointer-events: all;
    }
}
</style>
