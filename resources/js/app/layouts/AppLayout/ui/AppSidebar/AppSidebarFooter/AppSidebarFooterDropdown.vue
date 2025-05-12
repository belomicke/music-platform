<script setup lang="ts">
import { useCurrentUser } from "@/features/auth/current-user"
import { CurrentUserAvatar } from "@/entities/auth"
import { createDialog, IIcon } from "@/shared/ui"
import ISeparator from "@/shared/ui/Separator/ui/ISeparator.vue"
import { useLogOut } from "@/features/auth/log-out"

const emit = defineEmits(["close"])

const { data: user } = useCurrentUser()

const { fetch: logOut } = useLogOut()

const logOutHandler = () => {
    createDialog({
        title: "Выход",
        message: "Вы действительно хотите выйти?",
        confirmButtonText: "Выйти",
        onConfirm: () => logOut(),
    })
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
            >
                <i-icon icon="user"/>
                Настройки профиля
            </div>
            <div
                class="app-sidebar-footer-dropdown__option"
                @click="logOutHandler"
            >
                <i-icon icon="log-out"/>
                Выйти из аккаунта
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.app-sidebar-footer-dropdown {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;

    background-color: rgb(20, 20, 20);
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
        user-select: none;
        cursor: pointer;
        border-radius: 12px;
        transition: background-color .15s;

        &:hover {
            background-color: rgb(30, 30, 30);
        }
    }
}
</style>
