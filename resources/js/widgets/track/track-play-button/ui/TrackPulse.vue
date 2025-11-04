<script setup lang="ts">
</script>

<template>
    <div
        class="track-list-item-pulse"
    >
        <div
            class="track-list-item-pulse__pulse"
        />
    </div>
</template>

<style scoped lang="scss">
.track-list-item-pulse {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    inset-block-start: 0;
    inset-inline-start: 0;
    position: absolute;

    &__pulse {
        animation: pulse .7s ease-in-out infinite both;
        display: block;
        height: .5rem;
        width: .5rem;
        background-color: var(--ym-controls-color-primary-default-enabled);
        border-radius: var(--ym-radius-size-round);

        .track-list-item:hover & {
            opacity: 0;
        }
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1.6);
    }
    50% {
        transform: scale(1);
    }
}
</style>
