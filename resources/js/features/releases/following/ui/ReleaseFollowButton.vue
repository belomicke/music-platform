<script setup lang="ts">
import { computed } from "vue"
import { useReleaseFollowing } from "../hooks"
import { useCurrentUser } from "@/features/auth/current-user"
import { IconButtonVariants, IIconButton } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string,
    variant?: IconButtonVariants,
    size?: number,
    iconSize?: number
}>(), {
    variant: "ghost",
    size: 40,
    iconSize: 16,
})

const id = computed(() => props.id)

const { isAuth } = useCurrentUser()
const { isFollow, mutate } = useReleaseFollowing(id)
</script>

<template>
    <i-icon-button
        @click="mutate"
        :variant="variant"
        round
        icon="heart"
        :icon-size="iconSize"
        :filled="isFollow"
        :size="size"
        :disabled="isAuth === false"
    />
</template>

<style lang="scss">

</style>
