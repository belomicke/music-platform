<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { useNavigation } from "@/shared/hooks"
import { IButton } from "@/shared/ui"

const { t } = useI18n()
const { goToSignUpPage, goToSignInPage } = useNavigation()
</script>

<template>
    <div class="guest-buttons">
        <i-button
            variant="ghost"
            @click="goToSignUpPage"
        >
            {{ t("auth.button.text.sign-up") }}
        </i-button>
        <i-button
            @click="goToSignInPage"
        >
            {{ t("auth.button.text.sign-in") }}
        </i-button>
    </div>
</template>

<style lang="scss">
.guest-buttons {
    display: flex;
    gap: 16px;
}
</style>
