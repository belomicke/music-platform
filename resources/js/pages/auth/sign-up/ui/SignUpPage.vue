<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import SignUpForm from "./SignUpForm.vue"
import EmailVerificationForm from "./EmailVerificationForm.vue"
import { AuthFormContainer } from "@/entities/auth"
import { IFormParagraph, ILink } from "@/shared/ui"
import { CreateUserDTO } from "@/shared/api"

const { t } = useI18n()

const activeForm = ref<"sign-up" | "email-verification">("sign-up")

const credentials = ref<CreateUserDTO>({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    verification_code: "",
})

const formTitle = computed(() => {
    if (activeForm.value === "sign-up") {
        return "auth.form.title.sign-up"
    } else {
        return "auth.form.title.email-verification"
    }
})
</script>

<template>
    <auth-form-container
        :title="t(formTitle)"
    >
        <template v-if="credentials !== undefined">
            <sign-up-form
                v-if="activeForm === 'sign-up'"
                v-model:credentials="credentials"
                @submit="activeForm = 'email-verification'"
            />
            <email-verification-form
                v-else-if="activeForm === 'email-verification'"
                v-model:credentials="credentials"
                @back="activeForm = 'sign-up'"
            />
        </template>
    </auth-form-container>
    <i-form-paragraph>
        {{ t("auth.form.text.already-have-an-account") }}
        <i-link
            to="/auth/sign-in"
            tabindex="-1"
        >
            {{ t("auth.button.text.sign-in") }}
        </i-link>
    </i-form-paragraph>
</template>
