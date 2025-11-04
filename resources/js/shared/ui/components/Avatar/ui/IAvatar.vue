<script setup lang="ts">
import { ref } from "vue"
import { IconName, IIcon, IModal, UiSize } from "@/shared/ui"

const props = withDefaults(defineProps<{
    url?: string
    size?: string
    maxSize?: string
    clickable?: boolean
    icon?: IconName
    iconSize?: UiSize
    withModal?: boolean
    round?: boolean,
    withOverlay?: boolean
}>(), {
    size: "36px",
    maxSize: "100%",
    url: "",
    clickable: false,
    icon: "app-logo",
    iconSize: "s",
    withModal: false,
    round: false,
    withOverlay: false,
})

const emit = defineEmits(["click"])

const isLoaded = ref<boolean>(false)

const modalIsOpen = ref<boolean>(false)

const clickHandler = (e: MouseEvent) => {
    if (props.withModal && isLoaded.value === true) {
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
        :style="{
            'width': size,
        }"
        v-bind="$attrs"
    >
        <img
            class="i-avatar"
            :src="url"
            :class="[
                (clickable || withModal) && 'clickable',
                withOverlay && 'with-overlay',
                isLoaded === false && 'hidden'
            ]"
            :style="{
                'width': size,
            }"
            @click="clickHandler"
            @load="isLoaded = true"
            alt=""
            v-bind="$attrs"
            v-if="url"
        />

        <i-icon
            class="i-avatar__icon"
            :icon="icon"
            :size="iconSize"
            v-if="icon"
        />

        <div
            class="overlay"
            v-if="withOverlay"
        >
            <div class="overlay__action-group top">
                <div class="overlay__actions">
                    <slot name="overlay-top-left"></slot>
                </div>
                <div class="overlay__actions">
                    <slot name="overlay-top-right"></slot>
                </div>
            </div>
            <div class="overlay__action-group bottom">
                <div class="overlay__actions">
                    <slot name="overlay-bottom-left"></slot>
                </div>
                <div class="overlay__actions">
                    <slot name="overlay-bottom-right"></slot>
                </div>
            </div>
        </div>
    </div>

    <i-modal
        v-model:is-open="modalIsOpen"
        v-if="withModal"
    >
        <div
            class="i-avatar__modal"
            :style="{
                'background-image': `url(${props.url})`
            }"
        />
    </i-modal>
</template>

<style lang="scss">
.i-avatar-container {
    position: relative;
    aspect-ratio: 1 / 1;
    background-color: #202020;
    border-radius: var(--ym-radius-size-xs);

    &.round {
        border-radius: 50%;
    }

    &.with-overlay {
        &::before {
            content: "";
            height: 100%;
            width: 100%;
            position: absolute;
            inset-inline-start: 0;
            inset-block-start: 0;
            border-radius: var(--ym-radius-size-xs);
            pointer-events: none;
            z-index: 3;
            transition: background-color var(--ym-duration-transition);
        }

        &.round::before {
            border-radius: 50%;
        }

        &:hover::before {
            background-color: var(--ym-surface-color-primary-enabled-entity);
        }
    }
}

.i-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--color-background);
    background-size: cover;
    background-position: center center;
    aspect-ratio: 1 / 1;
    border-radius: var(--ym-radius-size-xs);
    width: 100%;
    position: relative;
    z-index: 2;

    &.hidden {
        opacity: 0;
    }

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
        border-radius: var(--ym-radius-size-xs);
    }

    &__icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;

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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;

    padding: var(--ym-spacer-size-m);

    inset-block-start: 0;
    inset-inline-start: 0;
    position: absolute;

    width: 100%;
    height: 100%;

    pointer-events: none;

    z-index: 4;

    --sliding-offset: var(--ym-spacer-size-m);

    &__action-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        opacity: 0;
        transition: transform var(--ym-duration-transition), opacity var(--ym-duration-transition);
        transition-delay: var(--ym-duration-transition-delay);

        &.top {
            transform: translateY(0 - var(--sliding-offset));
        }

        &.bottom {
            align-items: flex-end;
            gap: var(--ym-spacer-size-xs);
            justify-content: space-between;
            transform: translateY(var(--sliding-offset));

            .i-avatar-container:hover & {
                opacity: 1;
                transform: translateY(0);
            }
        }
    }

    &__actions {
        display: flex;
        align-items: center;
        gap: var(--ym-spacer-size-xs);

        & > * {
            pointer-events: all;
        }

        &.top {
            top: 0;
            opacity: 0;
            transition: top var(--ym-duration-transition), opacity var(--ym-duration-transition);

            .i-avatar-container:hover & {
                top: 10px;
                opacity: 1;
            }
        }

        &.bottom {
            display: flex;
            justify-content: space-between;
            align-items: end;
            bottom: 0;
            opacity: 0;
            transition: bottom var(--ym-duration-transition), opacity var(--ym-duration-transition);

            .i-avatar-container:hover & {
                bottom: 10px;
                opacity: 1;
            }
        }
    }
}
</style>
