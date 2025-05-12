<script setup lang="ts">
import { useRouter } from "vue-router"
import { IButton } from "@/shared/ui"

defineProps<{
    title: string
}>()

const router = useRouter()

const goBackHandler = () => {
    router.back()
}
</script>

<template>
    <div class="media-list-page">
        <div class="media-list-page-header">
            <i-button
                icon="chevron-left"
                variant="ghost"
                :icon-size="32"
                round
                @click="goBackHandler"
            />
            <h1 class="media-list-page-header__title">
                {{ title }}
            </h1>
        </div>
        <div class="media-list-page-content">
            <slot></slot>
        </div>
    </div>
</template>

<style lang="scss">
.media-list-page {
    &-header {
        display: flex;
        align-items: center;
        gap: 16px;

        position: sticky;
        top: 0;
        background-color: rgba(20, 20, 20, .8);
        backdrop-filter: blur(12px);
        z-index: 1;
        padding: 12px 24px;

        &__title {
            user-select: none;
        }
    }

    &-content {
        padding: 0 24px 24px;
    }
}
</style>
