<script setup lang="ts">
</script>

<template>
    <div
        class="track-list-item-pulse"
    />
</template>

<style scoped lang="scss">
.track-list-item-pulse {
    animation: pulse .25s infinite linear alternate;
    width: 12px;
    height: 12px;
    background-color: var(--color-primary);
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    .track-list-item:hover & {
        opacity: 0;
    }
}

@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        transform: translate(-50%, -50%) scale(1.1);
    }
    100% {
        transform: translate(-50%, -50%) scale(1.25);
    }
}
</style>
