<script setup lang="ts">
withDefaults(defineProps<{
    title?: string
    titleIsClickable?: boolean
}>(), {
    title: "",
    titleIsClickable: false,
})

const emit = defineEmits([
    "click-on-title",
])

const clickOnTitleHandler = () => {
    emit("click-on-title")
}
</script>

<template>
    <div class="media-section">
        <div
            class="media-section__title"
            v-if="title.length"
        >
            <h2
                class="media-section__title_text"
                :class="[
                    titleIsClickable && 'clickable'
                ]"
                @click="clickOnTitleHandler"
            >
                {{ title }}
            </h2>
        </div>
        <slot></slot>
    </div>
</template>

<style lang="scss">
.media-section {
    display: flex;
    flex-direction: column;
    gap: var(--ym-spacer-size-l);

    &__title {
        display: flex;
        padding-inline: var(--ym-spacer-size-xxl);

        &_text {
            font-size: var(--ym-font-size-headline-m);
            line-height: var(--ym-font-line-height-headline-m);
            font-weight: var(--ym-font-weight-bold);
            cursor: pointer;
            pointer-events: none;
            margin: 0;

            &.clickable {
                pointer-events: all;

                &:hover {
                    text-decoration: underline;
                }
            }
        }
    }
}
</style>
