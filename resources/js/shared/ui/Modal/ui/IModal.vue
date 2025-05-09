<script setup lang="ts">
const isOpen = defineModel<boolean>("is-open")

const closeHandler = () => {
    isOpen.value = false
}
</script>

<template>
    <teleport
        to="#portals"
        v-if="isOpen"
    >
        <div class="i-modal">
            <div
                class="i-modal__background"
                @click="closeHandler"
            />
            <div class="i-modal__content">
                <slot></slot>
            </div>
        </div>
    </teleport>
</template>

<style lang="scss">
.i-modal {
    display: flex;
    justify-content: center;
    align-items: center;

    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;

    &__background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .7);
        z-index: 1001;
    }

    &__content {
        position: relative;
        z-index: 1002;

        height: fit-content;
        width: fit-content;
    }
}
</style>
