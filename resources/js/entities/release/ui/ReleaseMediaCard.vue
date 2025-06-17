<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import ReleasePlayButton from "./ReleasePlayButton.vue"
import { ReleaseFollowButton } from "@/features/releases/following"
import { SeparatedArtists } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useNavigation } from "@/shared/hooks"
import { IAvatar } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string,
    avatarSize?: string
}>(), {
    avatarSize: "100%",
})

const { t } = useI18n()

const { goToReleaseInfoPage } = useNavigation()

const releaseStore = useReleaseStore()
const { getById } = storeToRefs(releaseStore)

const id = computed(() => props.id)
const release = computed(() => getById.value(id.value))

const year = computed(() => {
    return new Date(release.value.release_date).getFullYear()
})

const type = computed(() => {
    return t(`entities.release.types.${release.value.type}`)
})

const goToRelease = () => {
    goToReleaseInfoPage(id.value)
}
</script>

<template>
    <div
        class="release-media-card"
        v-if="release"
    >
        <i-avatar
            :url="release.image_url"
            :size="avatarSize"
            clickable
            with-overlay
            @click="goToRelease"
        >
            <template #overlay-bottom>
                <release-play-button
                    :release="release"
                />
                <release-follow-button
                    :id="release.id"
                    variant="primary"
                    :size="42"
                    :icon-size="20"
                />
            </template>
        </i-avatar>
        <div class="info">
            <div
                class="info__title"
                @click="goToRelease"
            >
                {{ release.title }}
            </div>
            <separated-artists
                :artists="release.artists"
            />
            <div class="info__type">
                {{ year }} · {{ type }}
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.release-media-card {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}

.info {
    display: flex;
    flex-direction: column;
    width: 100%;

    &__title {
        display: -webkit-box;

        font-size: 13px;
        font-weight: 500;
        line-height: 18px;
        cursor: pointer;

        overflow: hidden;
        text-overflow: ellipsis;

        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;

        &:hover {
            text-decoration: underline;
        }
    }

    &__type {
        display: block;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        -webkit-line-clamp: 1;
        color: var(--color-text-secondary);
    }
}
</style>
