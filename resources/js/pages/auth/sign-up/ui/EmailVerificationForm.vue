<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useCreateUser } from "@/features/auth/sign-up"
import { IButton, IFormButtons, IInput } from "@/shared/ui"
import { CreateUserDTO } from "@/shared/api"

const emit = defineEmits(["submit", "back"])

const { t } = useI18n()

const credentials = defineModel<CreateUserDTO>("credentials")

const { fetch: createUser, isLoading } = useCreateUser()

const formIsInvalid = computed(() => {
    return credentials.value.verification_code.length !== 6
})

const submitHandler = () => {
    if (formIsInvalid.value === false) {
        createUser(credentials.value)
    }
}

const goBackHandler = () => {
    emit("back")
}
</script>

<template>
    <i-input
        :label="t('auth.input.label.verification-code')"
        :placeholder="t('auth.input.placeholder.verification-code')"
        v-model="credentials.verification_code"
        id="verification-code"
        type="text"
    />
    <i-form-buttons>
        <i-button
            type="submit"
            :loading="isLoading"
            @click.prevent="submitHandler"
            :disabled="formIsInvalid"
        >
            {{ t("auth.button.action.sign-up") }}
        </i-button>
        <i-button
            variant="secondary"
            @click.prevent="goBackHandler"
        >
            {{ t("auth.button.text.back") }}
        </i-button>
    </i-form-buttons>
</template>

<style lang="scss">

</style>
