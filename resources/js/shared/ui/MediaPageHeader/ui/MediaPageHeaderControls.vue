<script setup lang="ts">

</script>

<template>
    <div class="media-page-header-controls">
        <div class="media-page-header-controls__controls-container">
            <div class="media-page-header-controls__controls">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header-controls {
    display: flex;
    gap: var(--ym-spacer-size-m);
    width: 100%;

    &__controls-container {
        display: flex;
        align-items: center;
        column-gap: var(--ym-spacer-size-m);
        row-gap: var(--ym-spacer-size-xxxl);
    }

    &__controls {
        display: flex;
        align-items: center;
        column-gap: var(--ym-spacer-size-m);
        row-gap: var(--ym-spacer-size-xxxl);
        flex-wrap: wrap;
        height: 100%;
    }
}
</style>
