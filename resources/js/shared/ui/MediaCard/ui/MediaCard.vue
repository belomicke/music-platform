<script setup lang="ts">

defineProps<{
    image?: string
    title: string
    subtitle: string
}>()
</script>

<template>
    <div class="media-card">
        <slot name="cover"></slot>
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

    height: 270px;

    border-radius: 6px;
    border: 1px solid var(--color-border);
    padding: 12px;
    user-select: none;
    cursor: pointer;
    transition: background-color .15s;

    @media (hover: hover) {
        &:hover {
            background-color: var(--color-background-secondary);
        }
    }

    &__cover {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 180px;
        width: 100%;
        aspect-ratio: 1 / 1;
        background-color: var(--color-background-secondary);
        border-radius: 50%;
        overflow: hidden;
    }

    &__image {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        width: 100%;
        aspect-ratio: 1 / 1;
    }

    &__icon {
        color: var(--color-text-secondary);
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
