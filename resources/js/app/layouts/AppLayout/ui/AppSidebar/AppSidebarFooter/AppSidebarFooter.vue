<script setup lang="ts">
import { ref } from "vue"
import AppSidebarFooterDropdown from "./AppSidebarFooterDropdown.vue"
import { useCurrentUser } from "@/features/auth/current-user"
import { CurrentUserAvatar } from "@/entities/auth"
import { useNavigation, useResponsive } from "@/shared/hooks"
import { IButton, IDropdown } from "@/shared/ui"

const { data: user, isAuth } = useCurrentUser()

const { deviceType } = useResponsive()

const { goToSignInPage, goToSignUpPage } = useNavigation()

const dropdownIsOpen = ref<boolean>(false)

const closeDropdown = () => {
    dropdownIsOpen.value = false
}
</script>

<template>
    <div class="app-sidebar-footer">
        <template v-if="isAuth">
            <i-dropdown
                v-model="dropdownIsOpen"
                position-y="top"
                position-x="left"
            >
                <template #trigger>
                    <div
                        class="app-sidebar-footer__user"
                        :class="[
                            dropdownIsOpen && 'active'
                        ]"
                    >
                        <current-user-avatar/>
                        <div class="app-sidebar-footer__name">
                            {{ user.name }}
                        </div>
                    </div>
                </template>
                <template #content>
                    <app-sidebar-footer-dropdown
                        @close="closeDropdown"
                    />
                </template>
            </i-dropdown>
        </template>

        <template v-else>
            <div class="app-sidebar-footer__auth-buttons" v-if="deviceType === 'desktop'">
                <i-button
                    variant="primary"
                    @click="goToSignInPage"
                >
                    Войти
                </i-button>
                <i-button
                    variant="outline"
                    @click="goToSignUpPage"
                >
                    Зарегистрироваться
                </i-button>
            </div>
            <div class="app-sidebar-footer__auth-buttons_compact" v-if="deviceType === 'tablet'">
                <i-button
                    icon="log-in"
                    variant="primary"
                    @click="goToSignInPage"
                />
                <i-button
                    icon="add-user"
                    variant="outline"
                    @click="goToSignUpPage"
                />
            </div>
        </template>
    </div>
</template>

<style lang="scss">
.app-sidebar-footer {
    width: 100%;

    &__user {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;

        padding: 12px;
        border-radius: 12px;

        transition: background-color .15s;

        &:hover, &.active {
            background-color: rgb(20, 20, 20);
        }
    }

    &__name {
        font-size: 16px;
        font-weight: 500;
        user-select: none;
    }

    &__auth-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        
        &_compact {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }
    }
}
</style>
