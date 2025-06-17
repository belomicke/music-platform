<script setup lang="ts">
import { computed } from "vue"
import { useTrackFollowing } from "../hook"
import { useCurrentUser } from "@/features/auth/current-user"
import { IIconButton } from "@/shared/ui"
import { ApiTrack } from "@/shared/api"

const props = withDefaults(defineProps<{
    track: ApiTrack
    size?: number
    iconSize?: number
}>(), {
    size: 40,
    iconSize: 20,
})

const { isAuth } = useCurrentUser()
const { isFavorite, mutate } = useTrackFollowing(computed(() => props.track.id))
</script>

<template>
    <i-icon-button
        icon="heart"
        :size="size"
        :icon-size="iconSize"
        :filled="isFavorite"
        @click="mutate"
        variant="transparent"
        :disabled="isAuth === false"
    />
</template>
