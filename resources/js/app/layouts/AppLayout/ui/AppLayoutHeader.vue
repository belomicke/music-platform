<script setup lang="ts">
import AuthUserDropdown from "./AuthUserDropdown.vue"
import GuestButtons from "./GuestButtons.vue"
import { useCurrentUser } from "@/features/auth/current-user"
import { useNavigation } from "@/shared/hooks"
import { IIcon } from "@/shared/ui"

const { goToHomePage } = useNavigation()

const { data: user, isAuth } = useCurrentUser()
</script>

<template>
    <div class="app-layout-header">
        <div
            class="app-layout-header__logo"
            @click="goToHomePage"
        >
            <i-icon
                icon="app-logo"
                :size="32"
            />
        </div>
        <template v-if="isAuth">
            <auth-user-dropdown
                :user="user"
            />
        </template>
        <template v-else>
            <guest-buttons/>
        </template>
    </div>
</template>

<style lang="scss">
.app-layout-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 64px;
    padding: 0 20px;
    border-radius: 6px;

    &__logo {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
}
</style>
