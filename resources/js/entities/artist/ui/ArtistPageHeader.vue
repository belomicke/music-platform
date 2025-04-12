<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { IAvatar, MediaPageHeader } from "@/shared/ui"
import { IArtist } from "@/shared/api"

const props = defineProps<{
    artist: IArtist
}>()

const { t, locale } = useI18n()

const followers = computed(() => {
    return Intl.NumberFormat(locale.value).format(props.artist.followers.total)
})

const avatarUrl = computed(() => {
    return props.artist.images[0].url
})
</script>

<template>
    <media-page-header
        :type="t('page.artist-info.header.type')"
        :title="artist.name"
        :subtitle="t('page.artist-info.header.subtitle', { followers })"
    >
        <template #avatar>
            <i-avatar
                :url="avatarUrl"
                :size="232"
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
