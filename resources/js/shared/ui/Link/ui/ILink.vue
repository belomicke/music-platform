<script setup lang="ts">
interface ILinkProps {
    to: string
}

defineProps<ILinkProps>()
</script>

<template>
    <router-link
        class="i-link"
        :to="to"
    >
        <slot></slot>
    </router-link>
</template>

<style lang="scss">
.i-link {
    color: var(--color-text);

    text-underline-offset: 4px;
    text-decoration-color: var(--color-text-secondary);

    transition: text-decoration-color .15s;

    &:hover {
        text-underline-offset: 4px;
        text-decoration-color: currentColor !important;
    }
}
</style>
