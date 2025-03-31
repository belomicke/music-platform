<script setup lang="ts">
import { useCurrentUser } from "@/features/auth/current-user"
import { IIcon } from "@/shared/ui"

const { isLoading } = useCurrentUser()
</script>

<template>
    <div
        class="loading-screen"
        v-if="isLoading"
    >
        <i-icon
            icon="app-logo"
            :size="64"
        />
    </div>
    <slot v-else></slot>
</template>

<style lang="scss">
.loading-screen {
    display: flex;
    justify-content: center;
    align-items: center;

    height: 100vh;
    width: 100vw;
}
</style>
