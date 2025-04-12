<script setup lang="ts">

</script>

<template>
    <div class="home-page-section">
        <div class="home-page-section__title">
            <h1>Популярные исполнители</h1>
        </div>
        <slot></slot>
    </div>
</template>

<style lang="scss">
.home-page-section {
    display: flex;
    flex-direction: column;
    gap: 8px;

    &__title {
        display: flex;
        user-select: none;

        & > h1 {
            font-size: 20px;
            line-height: 32px;
            font-weight: 600;
            cursor: pointer;
            margin: 0;

            &:hover {
                text-decoration: underline;
            }
        }
    }
}
</style>
