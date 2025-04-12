<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { UserAvatar } from "@/entities/user"
import { MediaPageHeader } from "@/shared/ui"
import { IUser } from "@/shared/api"

defineProps<{
    user: IUser
}>()

const { t } = useI18n()
</script>

<template>
    <media-page-header
        :title="user.name"
        :type="t('page.profile.header.type')"
        v-if="user"
    >
        <template #avatar>
            <user-avatar
                :size="232"
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">

</style>
