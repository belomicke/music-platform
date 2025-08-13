<script setup lang="ts">
import { useI18n } from "vue-i18n"
import PageHeaderReleaseMeta from "./PageHeaderReleaseMeta.vue"
import { ReleaseFollowButton } from "@/features/releases/following"
import ReleasePlayButton from "@/entities/release/ui/ReleasePlayButton.vue"
import { IAvatar, MediaPageHeader } from "@/shared/ui"
import { useResponsive } from "@/shared/hooks"
import type { ApiRelease } from "@/shared/api"

defineProps<{
    release: ApiRelease
}>()

const { t } = useI18n()

const { deviceType } = useResponsive()
</script>

<template>
    <media-page-header
        :type="t(`entities.release.types.${release.type}`)"
        :title="release.title"
    >
        <template #avatar>
            <i-avatar
                :url="release.image_url"
                size="226px"
                can-be-open-in-modal
            />
        </template>
        <template #meta>
            <page-header-release-meta
                :release="release"
            />
        </template>
        <template #actions>
            <release-play-button
                :release="release"
                variant="primary"
            />
            <release-follow-button
                :id="release.id"
                :size="deviceType === 'mobile' ? 64 : 44"
                :icon-size="deviceType === 'mobile' ? 32 : 22"
                v-if="release"
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
