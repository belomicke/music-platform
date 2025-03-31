<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import { useSignIn } from "@/features/auth/sign-in"
import { AuthFormContainer } from "@/entities/auth"
import { IButton, IFormButtons, IFormParagraph, IInput, ILink, showAlert } from "@/shared/ui"
import { isEmailValid, isPasswordValid } from "@/shared/utils"

const { t } = useI18n()

const email = ref<string>("")
const password = ref<string>("")

const { fetch, isLoading } = useSignIn({
    onError: data => {
        const message = data.response.data.message

        if (message === "Invalid credentials.") {
            showAlert({
                text: t("auth.errors.invalid-credentials"),
                type: "error",
            })
        }
    },
})

const formIsInvalid = computed(() => {
    return !isEmailValid(email.value) || !isPasswordValid(password.value)
})

function submitHandler() {
    fetch({
        email: email.value,
        password: password.value,
    })
}
</script>

<template>
    <div class="auth-form">
        <auth-form-container
            :title="t('auth.form.title.sign-in')"
        >
            <i-input
                :label="t('auth.input.label.email')"
                :placeholder="t('auth.input.placeholder.email')"
                id="email"
                v-model="email"
                type="email"
            />
            <i-input
                :label="t('auth.input.label.password')"
                :placeholder="t('auth.input.placeholder.password')"
                id="password"
                v-model="password"
                type="password"
            >
                <template #label>
                    <div class="sign-in-password-input-label">
                        <label for="password">{{ t("auth.input.label.password") }}</label>
                        <i-link
                            to="/auth/forgot-password"
                            tabindex="-1"
                        >
                            {{ t("auth.button.text.forgot-password") }}
                        </i-link>
                    </div>
                </template>
            </i-input>
            <i-form-buttons>
                <i-button
                    type="submit"
                    :loading="isLoading"
                    @click.prevent="submitHandler"
                    :disabled="formIsInvalid"
                >
                    {{ t("auth.button.action.sign-in") }}
                </i-button>
            </i-form-buttons>
        </auth-form-container>
        <i-form-paragraph>
            {{ t("auth.form.text.dont-have-an-account") }}
            <i-link
                to="/auth/sign-up"
                tabindex="-1"
            >
                {{ t("auth.button.text.sign-up") }}
            </i-link>
        </i-form-paragraph>
    </div>
</template>

<style lang="scss">
.sign-in-password-input-label {
    display: flex;
    justify-content: space-between;
}
</style>
