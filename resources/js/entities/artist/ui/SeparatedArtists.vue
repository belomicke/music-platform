<script setup lang="ts">

interface Artist {
    id: string
    name: string
}

withDefaults(defineProps<{
    artists: Artist[],
    variant?: "primary" | "secondary"
    size?: "m" | "s"
}>(), {
    size: "m",
    variant: "primary",
})
</script>

<template>
    <div
        class="separated-artists"
        :style="{
            '-webkit-line-clamp': 1
        }"
    >
        <template
            v-for="(artist, index) in artists"
            :key="artist.id"
        >
            <router-link
                target="_self"
                rel=""
                :aria-label="`Артист ${artist.name}`"
                :to="`/artist/${artist.id}`"
                class="separated-artists__link"
            >
                <span
                    class="separated-artists__label"
                    :class="[
                        size === 'm' && 'medium',
                        size === 's' && 'small',

                        variant
                    ]"
                >
                    {{ artist.name }}
                </span>
            </router-link>
            <template v-if="index !== artists.length - 1">
                {{ ", " }}
            </template>
        </template>
    </div>
</template>

<style lang="scss">
.separated-artists {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    word-break: break-word;
    color: var(--ym-controls-color-primary-text-enabled);

    transition: color var(--ym-duration-transition);

    @media only screen and (min-width: 768px) {
        & {
            display: contents;
        }
    }

    &__artist {
        color: inherit;
        cursor: pointer;
        transition: color .15s;

        &:hover {
            color: var(--color-text-primary);
        }
    }

    &__link {
        display: inline;
        border: none;
        cursor: pointer;
        outline: none;
        overflow: hidden;
        position: relative;
        color: var(--text-enabled-color);
        text-decoration: none;
        transition: color var(--ym-duration-transition);
    }

    &__label {
        display: inline;
        font-size: var(--ym-font-size-label-m);
        color: var(--ym-controls-color-primary-text-enabled);
        letter-spacing: var(--ym-letter-spacing-m);
        line-height: var(--ym-font-line-height-label-m);
        font-weight: var(--ym-font-weight-medium);
        transition: color var(--ym-duration-transition);

        &.medium {
            font-size: var(--ym-font-size-label-m);
        }

        &.small {
            font-size: var(--ym-font-size-label-s);
        }

        &.primary:hover {
            color: var(--ym-controls-color-primary-text-hovered);
        }

        &.secondary {
            --text-enabled-color: var(--ym-controls-color-primary-text-enabled);
            --text-hovered-color: var(--ym-controls-color-primary-text-enabled_variant);
            --text-disabled-color: var(--ym-controls-color-primary-text-disabled);

            color: var(--text-enabled-color);

            &:hover {
                color: var(--text-hovered-color);
            }
        }
    }
}
</style>
