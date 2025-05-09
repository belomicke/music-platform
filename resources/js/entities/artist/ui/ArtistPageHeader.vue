<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import ArtistAvatar from "./ArtistAvatar.vue"
import { type ApiArtist } from "@/shared/api"
import { MediaPageHeader } from "@/shared/ui"

const props = defineProps<{
    artist: ApiArtist
}>()

const { t, locale } = useI18n()

const followers = computed(() => {
    return Intl.NumberFormat(locale.value).format(props.artist.followers_count)
})
</script>

<template>
    <media-page-header
        :type="t('page.artist-info.header.type')"
        :title="artist.name"
        :subtitle="t('page.artist-info.header.subtitle', { followers })"
    >
        <template #avatar>
            <artist-avatar
                :id="artist.id"
                :size="232"
                can-be-open-in-modal
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
