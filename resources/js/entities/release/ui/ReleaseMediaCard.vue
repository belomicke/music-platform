<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import { ReleaseFollowButton } from "@/features/releases/following"
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

const { goToArtistInfoPage, goToReleaseInfoPage } = useNavigation()

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

const goToArtist = (id: string) => {
    goToArtistInfoPage(id)
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
                <div></div>
                <release-follow-button
                    class="overlay__action"
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
            <div class="info__artists">
                <template
                    v-for="(artist, index) in release.artists"
                    :key="artist.id"
                >
                    <span
                        class="info__artist"
                        @click="goToArtist(artist.id)"
                    >
                        {{ artist.name }}
                    </span>
                    <template v-if="index !== release.artists.length - 1">
                        {{ ", " }}
                    </template>
                </template>
            </div>
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

    &__artists {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        word-break: break-all;
        -webkit-line-clamp: 1;
        font-size: 13px;
        font-weight: 500;
        line-height: 18px;
        max-height: 18px;
        color: var(--color-text-secondary);
    }

    &__artist {
        color: inherit;
        cursor: pointer;
        transition: color .15s;

        &:hover {
            color: var(--color-text-primary);
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
