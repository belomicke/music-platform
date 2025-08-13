<script setup lang="ts">
import type { ApiRelease } from "@/shared/api"
import { SeparatedArtists } from "@/entities/artist"
import { computed } from "vue"

const props = defineProps<{
    release: ApiRelease
}>()

const year = computed(() => {
    return new Date(props.release.release_date).getFullYear()
})
</script>

<template>
    <div class="page-header-release-meta">
        <div class="page-header-release-meta__artist-cover">
            <img
                :src="release.artists[0].image_url"
                loading="lazy"
                alt=""
            />
        </div>
        <separated-artists
            class="page-header-release-meta__artists"
            :artists="release.artists"
        />
        <div class="page-header-release-meta__year dot">
            {{ year }}
        </div>
    </div>
</template>

<style lang="scss">
.page-header-release-meta {
    color: var(--ym-controls-color-primary-text-enabled);
    font-weight: var(--ym-font-weight-medium);

    @media only screen and (max-width: 767.98px) {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--ym-spacer-size-xxs);
    }

    &__artist-cover {
        display: inline-flex;
        width: 1.25rem;
        height: 1.25rem;
        position: relative;
        margin-inline-end: var(--ym-spacer-size-xxs);
        inset-block-start: var(--ym-spacer-size-xxxs);
        border-radius: var(--ym-radius-size-round);
        overflow: hidden;
    }

    &__artists {
        color: var(--ym-controls-color-primary-text-enabled);
    }

    &__year {
        font-style: normal;
        font-weight: var(--ym-font-weight-medium);
        margin: 0;
        padding: 0;
        color: var(--ym-controls-color-primary-text-enabled);
        font-size: var(--ym-font-size-label-m);
        letter-spacing: var(--ym-letter-spacing-m);
        line-height: var(--ym-font-line-height-label-m);

        &, &.dot:before {
            display: inline-block;
        }

        &.dot:before {
            content: "";
            width: .25rem;
            height: .25rem;
            background-color: var(--ym-controls-color-primary-text-enabled);
            border-radius: var(--ym-radius-size-round);
            margin-block-end: var(--ym-spacer-size-xxxs);
            margin-inline-end: var(--ym-spacer-size-m);
            margin-inline-start: var(--ym-spacer-size-m);
        }
    }
}
</style>
