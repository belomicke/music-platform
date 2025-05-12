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
    grid-template-columns: repeat(2, minmax(var(--min-column-size), 1fr)) !important;
    justify-content: space-between;
    gap: 24px;
    width: 100%;
    height: 270px;

    --min-column-size: 10.75rem;

    @media only screen and (min-width: 1024px) and (max-width: 1920px) {
        @container media-list-container (width >= 618px) {
            grid-template-columns: repeat(3, minmax(var(--min-column-size), 1fr)) !important;
        }

        @container media-list-container (width >= 815px) {
            grid-template-columns: repeat(4, minmax(var(--min-column-size), 1fr)) !important;
        }

        @container media-list-container (width >= 1010px) {
            grid-template-columns: repeat(5, minmax(var(--min-column-size), 1fr)) !important;
        }

        @container media-list-container (width >= 1206px) {
            grid-template-columns: repeat(6, minmax(var(--min-column-size), 1fr)) !important;
        }
    }
}
</style>
