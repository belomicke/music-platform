<script setup lang="ts">
import { useResponsive } from "@/shared/hooks"
import { computed } from "vue"

const props = defineProps<{
    title: String
}>()

const { deviceType } = useResponsive()

const titleLength = computed(() => {
    if (deviceType.value === "mobile") return "mobile"

    if (props.title.length > 32) return "long"
    else return "short"
})
</script>

<template>
    <div class="media-page-header-title">
        <div class="media-page-header-title__heading">
            <span
                class="media-page-header-title__font"
                :class="[
                    titleLength
                ]"
            >
                {{ title }}
            </span>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header-title {
    display: flex;
    gap: var(--ym-spacer-size-l);
    margin-block-end: var(--ym-spacer-size-xs);

    &__heading {
        font-size: var(--ym-font-size-headline-s);
        line-height: var(--ym-font-line-height-headline-s);
        font-weight: var(--ym-font-weight-bold);
        padding: 0;
        margin: 0;
        color: var(--ym-controls-color-primary-text-enabled_variant);
        max-width: 100%;
        word-break: break-word;
    }

    &__font {
        margin: 0;
        padding: 0;

        font-size: var(--ym-font-size-headline-l);
        line-height: var(--ym-font-line-height-headline-l);

        font-weight: var(--ym-font-weight-bold);
        font-style: normal;
        letter-spacing: normal;

        &.short {
            font-size: 54px;
            line-height: 48px;
        }

        &.long {
            font-size: 28px;
            line-height: 28px;
        }

        &.mobile {
            font-size: 24px;
            line-height: 26px;
            font-weight: 700;
            font-style: normal;
        }
    }
}
</style>
