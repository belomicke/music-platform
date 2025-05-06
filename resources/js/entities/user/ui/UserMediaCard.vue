<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useI18n } from "vue-i18n"
import UserAvatar from "./UserAvatar.vue"
import { useNavigation } from "@/shared/hooks"
import { MediaCard } from "@/shared/ui"
import { useCompactUserStore } from "@/entities/user"

const props = defineProps<{
    id: string
}>()

const { t } = useI18n()

const compactUserStore = useCompactUserStore()
const { getById: getCompactUserById } = storeToRefs(compactUserStore)

const id = computed(() => props.id)
const user = computed(() => getCompactUserById.value(id.value))

const { goToUserInfoPage } = useNavigation()
</script>

<template>
    <media-card
        :title="user.name"
        :subtitle="t('ui.media-card.type.user')"
        :image="user.image_url"
        @click="goToUserInfoPage(id)"
    >
        <template #cover>
            <user-avatar
                :size="164"
            />
        </template>
    </media-card>
</template>

<style lang="scss">

</style>
