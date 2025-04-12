<script setup lang="ts">
defineProps<{
    image: string
    title: string
    subtitle: string
}>()
</script>

<template>
    <div class="media-card">
        <div
            class="media-card__image"
            :style="{
                'background-image': `url(${image})`
            }"
        />
        <div class="media-card__info">
            <div class="media-card__title">
                <p>{{ title }}</p>
            </div>
            <div class="media-card__type">
                {{ subtitle }}
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.media-card {
    display: flex;
    flex-direction: column;
    gap: 8px;

    border-radius: 6px;
    border: 1px solid var(--color-border);
    padding: 12px;
    user-select: none;
    cursor: pointer;
    transition: background-color .15s;

    &:hover {
        background-color: var(--color-background-secondary);
    }

    &__image {
        max-width: 180px;
        width: 100%;
        aspect-ratio: 1 / 1;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        border-radius: 50%;
    }

    &__info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    &__title {
        font-size: 16px;
        font-weight: 500;
        line-height: 22px;
        width: 100%;

        & > p {
            margin: 0;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        &:hover {
            text-decoration: underline;
        }
    }

    &__type {
        color: var(--color-text-secondary);
    }
}
</style>
