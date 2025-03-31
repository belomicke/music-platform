<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useEmailVerificationCode } from "@/features/auth/sign-up"
import { isEmailValid, isPasswordValid, isUsernameValid } from "@/shared/utils/validation"
import { IButton, IFormButtons, IInput } from "@/shared/ui"
import type { CreateUserDTO } from "@/shared/api"

const emit = defineEmits(["submit"])

const { t } = useI18n()

const model = defineModel<CreateUserDTO>("credentials")

const { fetch: sendEmailVerificationCode, isLoading } = useEmailVerificationCode({
    onSuccess: (data) => {
        if (data.data.success) {
            emit("submit")
        }
    },
})

const formIsInvalid = computed(() => {
    return !isUsernameValid(model.value.name) ||
        !isEmailValid(model.value.email) ||
        !isPasswordValid(model.value.password) ||
        model.value.password !== model.value.password_confirmation
})

const submitHandler = () => {
    sendEmailVerificationCode(model.value.email)
}
</script>

<template>
    <i-input
        :label="t('auth.input.label.name')"
        :placeholder="t('auth.input.placeholder.name')"
        id="name"
        v-model="model.name"
        type="text"
    />
    <i-input
        :label="t('auth.input.label.email')"
        :placeholder="t('auth.input.placeholder.email')"
        id="email"
        v-model="model.email"
        type="email"
    />
    <i-input
        :label="t('auth.input.label.password')"
        :placeholder="t('auth.input.placeholder.password')"
        id="password"
        v-model="model.password"
        type="password"
    />
    <i-input
        :label="t('auth.input.label.confirm-password')"
        :placeholder="t('auth.input.placeholder.confirm-password')"
        id="password-confirmation"
        v-model="model.password_confirmation"
        type="password"
    />
    <i-form-buttons>
        <i-button
            type="submit"
            :loading="isLoading"
            @click.prevent="submitHandler"
            :disabled="formIsInvalid"
        >
            {{ t("auth.button.text.next") }}
        </i-button>
    </i-form-buttons>
</template>

<style lang="scss">

</style>
