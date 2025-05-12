<script setup lang="ts">
import { computed } from "vue"
import { useArtistFollowing } from "../hooks/useArtistFollowing"
import { useCurrentUser } from "@/features/auth/current-user"
import { type ApiArtist } from "@/shared/api"
import { IButton } from "@/shared/ui"

const props = defineProps<{
    artist: ApiArtist
}>()

const id = computed(() => props.artist.id)

const { isAuth } = useCurrentUser()

const { mutate } = useArtistFollowing(id)
</script>

<template>
    <i-button
        @click="mutate"
        variant="ghost"
        round
        icon="heart"
        :icon-size="16"
        :icon-filled="artist.is_followed"
        :disabled="isAuth === false"
    />
</template>

<style lang="scss">

</style>
