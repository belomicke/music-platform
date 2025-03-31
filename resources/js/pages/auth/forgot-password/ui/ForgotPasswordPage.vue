<script setup lang="ts">
import { ref } from "vue"
import ForgotPasswordForm from "./ForgotPasswordForm.vue"
import ForgotPasswordMailWasSent from "./ForgotPasswordMailWasSent.vue"

const mailSent = ref<boolean>(false)

const submitHandler = () => {
    mailSent.value = true
}
</script>

<template>
    <forgot-password-form
        @submit="submitHandler"
        v-if="mailSent === false"
    />
    <forgot-password-mail-was-sent
        v-else
    />
</template>
