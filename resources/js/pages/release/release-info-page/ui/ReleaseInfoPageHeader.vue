<script setup lang="ts">
import { useI18n } from "vue-i18n"
import PageHeaderReleaseMeta from "./PageHeaderReleaseMeta.vue"
import { ReleaseFollowButton } from "@/widgets/release/release-follow-button"
import { ReleasePlayButton } from "@/widgets/release/release-play-button"
import { ReleaseCover } from "@/entities/release"
import type { ApiRelease } from "@/shared/api"
import { MediaPageHeader } from "@/shared/ui"

defineProps<{
    release: ApiRelease
}>()

const { t } = useI18n()
</script>

<template>
    <media-page-header
        :type="t(`entities.release.types.${release.type}`)"
        :title="release.title"
    >
        <template #avatar>
            <release-cover
                :url="release.image_url"
                size="226px"
                with-modal
                clickable
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
            />
            <release-follow-button
                :id="release.id"
                variant="secondary"
                with-count
                v-if="release"
            />
        </template>
    </media-page-header>
</template>
