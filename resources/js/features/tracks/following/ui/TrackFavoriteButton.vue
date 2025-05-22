<script setup lang="ts">
import { computed } from "vue"
import { useTrackFollowing } from "../hook"
import { useCurrentUser } from "@/features/auth/current-user"
import { IIconButton } from "@/shared/ui"
import { ApiTrack } from "@/shared/api"

const props = defineProps<{
    track: ApiTrack
}>()

const { isAuth } = useCurrentUser()
const { isFavorite, mutate } = useTrackFollowing(computed(() => props.track.id))
</script>

<template>
    <i-icon-button
        icon="heart"
        :filled="isFavorite"
        @click="mutate"
        variant="transparent"
        :disabled="isAuth === false"
    />
</template>
