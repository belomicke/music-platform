<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { ReleaseFollowButton } from "@/features/releases/following"
import { IAvatar, MediaPageHeader } from "@/shared/ui"
import type { ApiRelease } from "@/shared/api"
import { useNavigation, useResponsive } from "@/shared/hooks"

const props = defineProps<{
    release: ApiRelease
}>()

const { t } = useI18n()

const { deviceType } = useResponsive()
const { goToArtistInfoPage } = useNavigation()

const year = computed(() => {
    return new Date(props.release.release_date).getFullYear()
})

const goToArtist = (id: string) => {
    goToArtistInfoPage(id)
}
</script>

<template>
    <media-page-header
        :type="t(`entities.release.types.${release.type}`)"
        :title="release.title"
    >
        <template #avatar>
            <i-avatar
                :url="release.image_url"
                :size="204"
                can-be-open-in-modal
            />
        </template>
        <template #meta>
            <div
                class="artist"
                v-if="release.artists.length === 1"
            >
                <i-avatar
                    :url="release.artists[0].image_url"
                    :size="20"
                    round
                />
                <div
                    class="artist__name"
                    @click="goToArtist(release.artists[0].id)"
                >
                    {{ release.artists[0].name }}
                </div>
            </div>
            <div class="year">{{ year }}</div>
        </template>
        <template #actions>
            <div class="artist-page-header-actions">
                <release-follow-button
                    :id="release.id"
                    :size="deviceType === 'mobile' ? 64 : 40"
                    :icon-size="deviceType === 'mobile' ? 32 : 20"
                    v-if="release"
                />
            </div>
        </template>
    </media-page-header>
</template>

<style scoped lang="scss">
.artist {
    display: flex;
    gap: 8px;

    &__name {
        cursor: pointer;
        color: var(--color-text-secondary);
        font-size: 14px;
        font-weight: 500;
        transition: color .15s;

        &:hover {
            color: var(--color-primary-hover);
        }
    }
}

.year {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--color-text-secondary);

    font-size: 14px;
    font-weight: 500;

    &::before {
        content: "";
        display: block;
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background-color: var(--color-text-secondary);
    }
}
</style>
