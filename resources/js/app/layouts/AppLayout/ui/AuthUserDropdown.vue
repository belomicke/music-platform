<script setup lang="ts">
import { ref } from "vue"
import { useI18n } from "vue-i18n"
import { useLogOut } from "@/features/auth/log-out"
import { UserAvatar } from "@/entities/user"
import { createDialog, IDropdown, IMenu } from "@/shared/ui"
import { useNavigation } from "@/shared/hooks"
import { ApiCurrentUser } from "@/shared/api"

const props = defineProps<{
    user: ApiCurrentUser
}>()

const { t } = useI18n()

const dropdownIsOpen = ref<boolean>(false)
const { goToUserInfoPage } = useNavigation()

const { fetch: logout } = useLogOut()

const goToProfileHandler = () => {
    goToUserInfoPage(props.user.id)
    dropdownIsOpen.value = false
}

const logOutHandler = () => {
    createDialog({
        title: t("auth.dialog.title.log-out"),
        message: t("auth.dialog.message.log-out"),
        confirmButtonText: t("auth.dialog.action.log-out"),
        onConfirm: () => logout(),
    })
    dropdownIsOpen.value = false
}
</script>

<template>
    <i-dropdown
        v-model="dropdownIsOpen"
        position-x="right"
        position-y="bottom"
    >
        <template #trigger>
            <user-avatar
                clickable
            />
        </template>
        <template #content>
            <i-menu
                :options="[
                    {
                        text: t('layouts.app.header.auth-user-dropdown.user-profile'),
                        onClick: goToProfileHandler
                    },
                    {
                        text: t('layouts.app.header.auth-user-dropdown.log-out'),
                        onClick: logOutHandler
                    }
                ]"
            />
        </template>
    </i-dropdown>
</template>

<style lang="scss">

</style>
