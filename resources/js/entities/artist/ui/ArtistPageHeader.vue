<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { ArtistFollowButton } from "@/features/artists/following"
import { IAvatar, MediaPageHeader } from "@/shared/ui"
import { useResponsive } from "@/shared/hooks"
import { type ApiArtist } from "@/shared/api"

defineProps<{
    artist: ApiArtist
}>()

const { t } = useI18n()
const { deviceType } = useResponsive()
</script>

<template>
    <media-page-header
        :type="t('page.artist-info.header.type')"
        :title="artist.name"
    >
        <template #avatar>
            <i-avatar
                :url="artist.image_url"
                :size="deviceType === 'mobile' ? '168px' : '204px'"
                can-be-open-in-modal
                round
            />
        </template>
        <template #actions>
            <artist-follow-button
                :id="artist.id"
                :size="deviceType === 'mobile' ? 64 : 40"
                :icon-size="deviceType === 'mobile' ? 32 : 20"
                v-if="artist"
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
