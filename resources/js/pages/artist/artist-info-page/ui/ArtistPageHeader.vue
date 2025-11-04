<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { ArtistFollowButton } from "@/widgets/artist/artist-follow-button"
import { ArtistAvatar } from "@/entities/artist"
import { useResponsive } from "@/shared/hooks"
import { MediaPageHeader } from "@/shared/ui"
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
            <artist-avatar
                :artist="artist"
                :size="deviceType === 'mobile' ? '168px' : '12.75rem'"
                with-modal
                clickable
            />
        </template>
        <template #meta></template>
        <template #actions>
            <artist-follow-button
                :id="artist.id"
                variant="secondary"
                v-if="artist"
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
