<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import ArtistAvatar from "./ArtistAvatar.vue"
import { ArtistFollowButton } from "@/features/artists/following"
import { type ApiArtist } from "@/shared/api"
import { MediaPageHeader } from "@/shared/ui"

const props = defineProps<{
    artist: ApiArtist
}>()

const { t, locale } = useI18n()

const followers = computed(() => {
    return Intl.NumberFormat(locale.value).format(props.artist.followers_count)
})

const text = computed(() => {
    return t(
        "followers",
        props.artist.followers_count,
        {
            named: {
                count: followers.value,
            },
        })
})
</script>

<template>
    <media-page-header
        :type="t('page.artist-info.header.type')"
        :title="artist.name"
    >
        <template #avatar>
            <artist-avatar
                :id="artist.id"
                :size="204"
                can-be-open-in-modal
            />
        </template>
        <template #meta>
            <div class="artist-page-header-meta">
                <div class="artist-page-header-meta__followers">{{ text }}</div>
            </div>
        </template>
        <template #actions>
            <div class="artist-page-header-actions">
                <artist-follow-button
                    :id="artist.id"
                    :size="40"
                    :icon-size="20"
                    v-if="artist"
                />
            </div>
        </template>
    </media-page-header>
</template>

<style lang="scss">
.artist-page-header-meta {
    &__followers {
        font-size: 14px;
        font-weight: 500;
    }
}
</style>
