<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import { useRoute } from "vue-router"
import { useResetPassword } from "@/features/auth/reset-password"
import { AuthFormContainer } from "@/entities/auth"
import { IButton, IFormButtons, IFormParagraph, IInput, ILink, showAlert } from "@/shared/ui"
import { isPasswordValid } from "@/shared/utils"
import { useNavigation } from "@/shared/hooks"

const { t } = useI18n()
const { goToSignInPage } = useNavigation()

const route = useRoute()

const password = ref<string>("")
const passwordConfirmation = ref<string>("")

const { fetch, isLoading } = useResetPassword({
    onSuccess: (data) => {
        if (data.data.success) {
            goToSignInPage()
        }
    },
    onError: data => {
        const message = data.response.data.message

        if (message === "Expired token.") {
            showAlert({
                text: t("auth.errors.expired-token"),
                type: "error",
            })
        }
    },
})

const formIsInvalid = computed(() => {
    return !isPasswordValid(password.value) ||
        password.value !== passwordConfirmation.value
})

const submitHandler = () => {
    const token = route.query.token as string
    const email = route.query.email as string

    if (!token || !email) return

    fetch({
        token,
        email,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
    })
}
</script>

<template>
    <auth-form-container
        :title="t('auth.form.title.reset-password')"
    >
        <i-input
            :label="t('auth.input.label.password')"
            :placeholder="t('auth.input.placeholder.password')"
            v-model="password"
            id="password"
            type="password"
        />
        <i-input
            :label="t('auth.input.label.confirm-password')"
            :placeholder="t('auth.input.placeholder.confirm-password')"
            v-model="passwordConfirmation"
            id="password-confirmation"
            type="password"
        />
        <i-form-buttons>
            <i-button
                type="submit"
                :loading="isLoading"
                @click.prevent="submitHandler"
                :disabled="formIsInvalid"
            >
                {{ t("auth.button.action.reset-password") }}
            </i-button>
        </i-form-buttons>
    </auth-form-container>
    <i-form-paragraph>
        {{ t("auth.form.text.recall-your-password") }}
        <i-link to="/auth/sign-in">
            {{ t("auth.button.text.sign-in") }}
        </i-link>
    </i-form-paragraph>
</template>
