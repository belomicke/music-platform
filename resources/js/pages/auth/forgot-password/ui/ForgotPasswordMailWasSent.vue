<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { AuthFormContainer } from "@/entities/auth"

const { t } = useI18n()
</script>

<template>
    <auth-form-container
        :title="t('auth.form.title.success')"
    >
        <div class="forgot-password-mail-was-sent">
            <p class="forgot-password-mail-was-sent__title">
                {{ t("auth.form.text.reset-password-mail-was-sent") }}
            </p>
            <p class="forgot-password-mail-was-sent__subtitle">
                {{ t("auth.form.text.you-can-close-this-page-now") }}
            </p>
        </div>
    </auth-form-container>
</template>

<style lang="scss">
.forgot-password-mail-was-sent {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding-bottom: 32px;

    & > p {
        margin: 0;
        text-align: center;
    }

    &__title {
        font-size: 16px;
        line-height: 24px;
        font-weight: 600;
    }

    &__subtitle {
        color: var(--color-text-secondary);
    }
}
</style>
