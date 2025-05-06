<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useUserFollowing } from "../hooks/useUserFollowing"
import type { ApiUser } from "@/shared/api"
import { IButton } from "@/shared/ui"

const props = defineProps<{
    user: ApiUser
}>()

const id = computed(() => props.user.id)

const { t } = useI18n()
const { mutate, isFollow } = useUserFollowing(id)

const buttonText = computed(() => {
    if (props.user.is_followed) {
        return t("features.user.following.button-text.unfollow")
    } else {
        return t("features.user.following.button-text.follow")
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
