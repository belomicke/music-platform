<script setup lang="ts">

</script>

<template>
    <div class="media-page-header-meta">
        <slot></slot>
    </div>
</template>

<style lang="scss">
.media-page-header-meta {
    margin-block-end: var(--ym-spacer-size-xxxl);

    @media only screen and (max-width: 767.98px) {
        margin-block-end: 0;
    }
}
</style>
