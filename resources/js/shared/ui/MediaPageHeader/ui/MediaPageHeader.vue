<script setup lang="ts">
import { computed, useSlots } from "vue"
import { useResponsive } from "@/shared/hooks"
import MediaPageHeaderTitle from "@/shared/ui/MediaPageHeader/ui/MediaPageHeaderTitle.vue"
import MediaPageHeaderMeta from "@/shared/ui/MediaPageHeader/ui/MediaPageHeaderMeta.vue"
import MediaPageHeaderControls from "@/shared/ui/MediaPageHeader/ui/MediaPageHeaderControls.vue"

const props = defineProps<{
    title: string
    type: string
}>()

const slots = useSlots()

const { deviceType } = useResponsive()

const titleLength = computed(() => {
    if (deviceType.value === "mobile") return "mobile"

    if (props.title.length > 32) return "long"
    else return "short"
})

const hasMeta = computed(() => {
    return slots["meta"]
})
</script>

<template>
    <div class="media-page-header">
        <slot name="avatar"/>
        <div class="media-page-header__content">
            <div class="media-page-header__info">
                <div
                    class="media-page-header__entity-name"
                    v-if="deviceType !== 'mobile'"
                >
                    {{ type }}
                </div>
                <media-page-header-title
                    :title="title"
                />
                <media-page-header-meta
                    v-if="hasMeta"
                >
                    <slot name="meta"></slot>
                </media-page-header-meta>
            </div>
            <media-page-header-controls>
                <slot name="actions"></slot>
            </media-page-header-controls>
        </div>
    </div>
</template>

<style lang="scss">
.media-page-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem;

    width: 100%;

    container-name: media-page-header;

    @media only screen and (max-width: 1060px) {
        flex-direction: column;
        align-items: start;
    }

    @media only screen and (max-width: 768px) {
        align-items: center;
    }

    &__content {
        display: flex;
        flex-direction: column;
        flex: 1 1;
        height: 100%;
    }

    &__info {
        display: flex;
        flex-direction: column;
        width: 100%;

        @media only screen and (max-width: 768px) {
            margin-bottom: 24px;
        }
    }

    &__entity-name {
        align-items: center;
        color: var(--ym-controls-color-primary-text-enabled);
        display: flex;
        gap: var(--ym-spacer-size-xs);

        margin: 0;
        padding: 0;

        font-weight: var(--ym-font-weight-medium);
        font-size: var(--ym-font-size-label-m);
        font-style: normal;
        letter-spacing: normal;
        line-height: var(--ym-font-line-height-label-m);
    }
}
</style>
