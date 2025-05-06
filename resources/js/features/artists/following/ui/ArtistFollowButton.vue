<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useArtistFollowing } from "../hooks/useArtistFollowing"
import { type ApiArtist } from "@/shared/api"
import { IButton } from "@/shared/ui"

const props = defineProps<{
    artist: ApiArtist
}>()

const id = computed(() => props.artist.id)

const { t } = useI18n()
const { isFollow, mutate } = useArtistFollowing(id)

const buttonText = computed(() => {
    if (props.artist.is_followed) {
        return t("features.artist.following.button-text.unfollow")
    } else {
        return t("features.artist.following.button-text.follow")
    }
})
</script>

<template>
    <i-button
        @click="mutate"
        :variant="isFollow ? 'outline' : 'primary'"
        round
    >
        {{ buttonText }}
    </i-button>
</template>

<style lang="scss">

</style>
