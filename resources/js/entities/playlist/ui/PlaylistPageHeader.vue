<script setup lang="ts">
import { IAvatar, MediaPageHeader } from "@/shared/ui"

defineProps<{
    title: string
    creator: string
}>()
</script>

<template>
    <media-page-header
        type="Плейлист"
        :title="title"
    >
        <template #avatar>
            <i-avatar
                icon="heart"
                size="204px"
            />
        </template>
        <template #meta>
            <div class="playlist-page-header__creator">{{ creator }}</div>
        </template>
    </media-page-header>
</template>

<style scoped lang="scss">
.playlist-page-header__creator {
    font-size: 14px;
    font-weight: 500;
    color: var(--color-text-secondary);
}
</style>
