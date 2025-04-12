<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import { useArtistStore } from "../model"
import { useNavigation } from "@/shared/hooks"
import { MediaCard } from "@/shared/ui"

const props = defineProps<{
    id: string
}>()

const { t } = useI18n()

const artistStore = useArtistStore()
const { getArtistById } = storeToRefs(artistStore)

const id = computed(() => props.id)
const artist = computed(() => getArtistById.value(id.value))

const { goToArtistInfoPage } = useNavigation()
</script>

<template>
    <media-card
        :image="artist.images[0].url"
        :title="artist.name"
        :subtitle="t('ui.media-card.type.artist')"

        @click="goToArtistInfoPage(id)"
    />
</template>

<style lang="scss">

</style>
