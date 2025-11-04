<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { SeparatedArtists } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"
import { ApiRelease } from "@/shared/api"

const props = defineProps<{
    release: ApiRelease
}>()

const emit = defineEmits(["click"])

const { t } = useI18n()

const { goToReleaseInfoPage } = useNavigation()

const goToRelease = () => {
    emit("click")
    goToReleaseInfoPage(props.release.id)
}

const year = computed(() => {
    return new Date(props.release.release_date).getFullYear()
})

const type = computed(() => {
    return t(`entities.release.types.${props.release.type}`)
})

</script>

<template>
    <div class="release-media-card-info">
        <div
            class="release-media-card-info__title"
            @click="goToRelease"
        >
            <span>{{ release.title }}</span>
        </div>
        <separated-artists
            class="release-media-card-info__artists"
            :artists="release.artists"
            variant="secondary"
            size="s"
        />
        <div class="release-media-card-info__type">
            {{ year }} · {{ type }}
        </div>
    </div>
</template>

<style lang="scss">
.release-media-card-info {
    display: flex;
    flex-direction: column;
    width: 100%;

    &__title {
        display: flex;

        & > span {
            display: -webkit-box;

            font-size: var(--ym-font-size-label-s);
            font-weight: var(--ym-font-weight-medium);
            line-height: var(--ym-font-line-height-label-s);
            cursor: pointer;

            overflow: hidden;
            text-overflow: ellipsis;

            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;

            &:hover {
                text-decoration: underline;
            }
        }
    }

    &__artists {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    &__type {
        display: block;
        font-size: var(--ym-font-size-label-s);
        line-height: var(--ym-font-line-height-label-s);
        font-weight: var(--ym-font-weight-medium);
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        -webkit-line-clamp: 1;
        color: var(--color-text-secondary);
    }
}
</style>
