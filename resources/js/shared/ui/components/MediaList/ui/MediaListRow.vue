<script setup lang="ts">

</script>

<template>
    <div class="media-list-row">
        <slot></slot>
    </div>
</template>

<style scoped lang="scss">
.media-list-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(var(--min-column-size), 1fr));
    justify-content: space-between;
    gap: calc(var(--ym-spacer-size-m) * 2);
    width: 100%;

    --min-column-size: 10.75rem;

    @media only screen {
        @container media-list-container (width >= 360px) {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        @container media-list-container (width >= 540px) {
            grid-template-columns: repeat(3, 1fr) !important;
        }

        @container media-list-container (width >= 768px) {
            grid-template-columns: repeat(4, 1fr) !important;
        }

        @container media-list-container (width >= 1010px) {
            grid-template-columns: repeat(5, 1fr) !important;
        }

        @container media-list-container (width >= 1206px) {
            grid-template-columns: repeat(6, 1fr) !important;
        }
    }
}
</style>
