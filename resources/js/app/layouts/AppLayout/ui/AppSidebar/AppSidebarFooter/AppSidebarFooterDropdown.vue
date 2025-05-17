<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import { EditAccountInfoModal } from "@/features/me/edit-account-info"
import { useCurrentUser } from "@/features/auth/current-user"
import { useLogOut } from "@/features/auth/log-out"
import { CurrentUserAvatar } from "@/entities/auth"
import { createDialog, IconName, IIcon, ISeparator } from "@/shared/ui"

interface Option {
    text: string
    icon: IconName
    onClick: () => void
}

const { t } = useI18n()

const emit = defineEmits(["close"])

const editAccountInfoModalIsOpen = ref<boolean>(false)

const { data: user } = useCurrentUser()

const { fetch: logOut } = useLogOut()

const options = computed((): Option[] => {
    return [
        {
            text: t("layouts.app.sidebar.footer.dropdown.options.edit-account-info"),
            icon: "user",
            onClick: () => openEditAccountInfoModal(),
        },
        {
            text: t("layouts.app.sidebar.footer.dropdown.options.log-out"),
            icon: "log-out",
            onClick: () => logOutHandler(),
        },
    ]
})

const logOutHandler = () => {
    createDialog({
        title: t("layouts.app.sidebar.footer.dropdown.dialogs.log-out.title"),
        message: t("layouts.app.sidebar.footer.dropdown.dialogs.log-out.message"),
        confirmButtonText: t("layouts.app.sidebar.footer.dropdown.dialogs.log-out.confirm-button-text"),
        onConfirm: () => logOut(),
    })
}

const openEditAccountInfoModal = () => {
    editAccountInfoModalIsOpen.value = true
}
</script>

<template>
    <div class="app-sidebar-footer-dropdown">
        <current-user-avatar
            :size="52"
        />
        <div class="app-sidebar-footer-dropdown__username">{{ user.name }}</div>

        <i-separator type="horizontal"/>

        <div class="app-sidebar-footer-dropdown__options">
            <div
                class="app-sidebar-footer-dropdown__option"
                @click="option.onClick"

                v-for="option in options"
                :key="option.text"
            >
                <i-icon :icon="option.icon"/>
                {{ option.text }}
            </div>
        </div>
    </div>

    <edit-account-info-modal
        v-model:is-open="editAccountInfoModalIsOpen"
    />
</template>

<style lang="scss">
.app-sidebar-footer-dropdown {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;

    background-color: var(--color-background);
    padding: 24px 12px;
    border: 1px solid var(--color-border);
    border-radius: 12px;
    width: 320px;

    &__username {
        font-size: 16px;
        font-weight: 600;
    }

    &__options {
        display: flex;
        flex-direction: column;
        gap: 4px;
        width: 100%;
    }

    &__option {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        border-radius: 12px;
        transition: background-color .15s;

        &:hover {
            background-color: var(--color-background-hover);
        }
    }
}
</style>
