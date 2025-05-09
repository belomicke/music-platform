<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import ArtistAvatar from "./ArtistAvatar.vue"
import { useCompactArtistStore } from "@/entities/artist"
import { useNavigation } from "@/shared/hooks"
import { MediaCard } from "@/shared/ui"

const props = defineProps<{
    id: string
}>()

const { t } = useI18n()

const compactArtistStore = useCompactArtistStore()
const { getById: getCompactArtistById } = storeToRefs(compactArtistStore)

const id = computed(() => props.id)
const artist = computed(() => getCompactArtistById.value(id.value))

const { goToArtistInfoPage } = useNavigation()
</script>

<template>
    <media-card
        :title="artist.name"
        :subtitle="t('ui.media-card.type.artist')"
        :image="artist.image_url"
        @click="goToArtistInfoPage(id)"
    >
        <template #cover>
            <artist-avatar
                :id="id"
                :size="164"
            />
        </template>
    </media-card>
</template>

<style lang="scss">

</style>
