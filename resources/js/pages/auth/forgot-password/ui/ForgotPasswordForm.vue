<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import { useForgotPassword } from "@/features/auth/forgot-password"
import { AuthFormContainer } from "@/entities/auth"
import { IButton, IFormButtons, IFormParagraph, IInput, ILink } from "@/shared/ui"
import { isEmailValid } from "@/shared/utils"

const emit = defineEmits(["submit"])

const { t } = useI18n()

const email = ref<string>("")

const { fetch, isLoading } = useForgotPassword({
    onSuccess: (res) => {
        if (res.data.success) {
            emit("submit")
        }
    },
})

const formIsInvalid = computed(() => {
    return !isEmailValid(email.value)
})

const submitHandler = () => {
    fetch(email.value)
}
</script>

<template>
    <auth-form-container
        :title="t('auth.form.title.forgot-password')"
    >
        <i-input
            :label="t('auth.input.label.email')"
            :placeholder="t('auth.input.placeholder.email')"
            id="email"
            v-model="email"
            type="email"
        />
        <i-form-buttons>
            <i-button
                type="submit"
                :loading="isLoading"
                @click.prevent="submitHandler"
                :disabled="formIsInvalid"
            >
                {{ t("auth.button.action.forgot-password") }}
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
