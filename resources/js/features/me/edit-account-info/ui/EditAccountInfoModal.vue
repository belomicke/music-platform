<script setup lang="ts">
import { computed, ref, useTemplateRef, watch } from "vue"
import { useI18n } from "vue-i18n"
import { useEditAccountInfo } from "../api"
import { useCurrentUser } from "@/features/auth/current-user"
import { IAvatar, IButton, IIconButton, IInput, IModal, showAlert } from "@/shared/ui"
import { EditAccountInfoDTO } from "@/shared/api"

const { t } = useI18n()

const isOpen = defineModel<boolean>("is-open")

const { data: user } = useCurrentUser()

const { fetch: editAccountInfo, isLoading } = useEditAccountInfo()

const avatarInputRef = useTemplateRef("avatarInputRef")

const name = ref<string>(user.value.name)
const avatarUrl = ref<string>(user.value.image_url)

const avatarFile = ref<File | undefined>(undefined)

const formIsInvalid = computed(() => {
    return avatarFile.value === undefined && name.value === user.value.name
})

watch(isOpen, () => {
    if (isOpen.value === false) {
        clearChanges()
    }
})

const openAvatarFilePicker = () => {
    const el = avatarInputRef.value as HTMLInputElement

    if (!el) return

    el.click()
}

const fileInputChangeHandler = () => {
    const el = avatarInputRef.value as HTMLInputElement

    if (!el) return

    const file = el.files[0]

    if (file.type.startsWith("image/") === false) {
        showAlert({
            text: t("features.me.edit-account-info.errors.invalid-type"),
            duration: 5000,
            type: "error",
        })
        return
    }

    if (bytesToMBytes(file.size) > 2) {
        showAlert({
            text: t("features.me.edit-account-info.errors.invalid-size"),
            duration: 5000,
            type: "error",
        })
        return
    }

    avatarFile.value = file
    avatarUrl.value = URL.createObjectURL(file)
}

const bytesToMBytes = (bytes: number): number => {
    const BYTES_IN_ONE_MEGABYTE = 1048576

    return Number((bytes / BYTES_IN_ONE_MEGABYTE).toFixed(3))
}

const submitForm = () => {
    const data: EditAccountInfoDTO = {}

    if (name.value !== user.value.name) {
        data.name = name.value
    }

    if (avatarFile.value !== undefined) {
        data.avatar = avatarFile.value
    }

    editAccountInfo(data)
}

const clearChanges = () => {
    avatarFile.value = undefined
    avatarUrl.value = user.value.image_url
    name.value = user.value.name
}
</script>

<template>
    <i-modal v-model:is-open="isOpen">
        <div class="edit-account-info-modal">
            <div class="header">
                <div class="header__title">
                    {{ t("features.me.edit-account-info.ui.modal.title") }}
                </div>
            </div>

            <div class="content">
                <div class="avatar-changer">
                    <input
                        type="file"
                        @change="fileInputChangeHandler"
                        style="display: none;"
                        ref="avatarInputRef"
                    />
                    <div class="avatar-changer__avatar">
                        <i-avatar
                            :url="avatarUrl"
                            :size="96"
                            clickable
                            icon="user"
                            @click="openAvatarFilePicker"
                        />
                        <i-icon-button
                            variant="grey"
                            class="avatar-changer__change-button"
                            icon="pencil"
                            :icon-size="16"
                            @click="openAvatarFilePicker"
                        />
                    </div>
                </div>

                <i-input
                    v-model="name"
                    :label="t('features.me.edit-account-info.ui.modal.inputs.name.label')"
                    :placeholder="t('features.me.edit-account-info.ui.modal.inputs.name.placeholder')"
                />

                <i-button
                    variant="primary"
                    block
                    @click="submitForm"
                    :loading="isLoading"
                    :disabled="formIsInvalid"
                >
                    {{ t("features.me.edit-account-info.ui.modal.buttons.submit.text") }}
                </i-button>
            </div>
        </div>
    </i-modal>
</template>

<style scoped lang="scss">
.edit-account-info-modal {
    display: flex;
    flex-direction: column;

    background-color: rgb(20, 20, 20);
    border-radius: 12px;
    min-width: 320px;
    width: 420px;

    @media (max-width: 420px) {
        width: 100%;
    }
}

.header {
    padding: 32px 32px 16px;

    &__title {
        font-size: 24px;
        font-weight: 600;
    }
}

.avatar-changer {
    display: flex;
    justify-content: center;
    align-items: center;

    &__avatar {
        cursor: pointer;
        border-radius: 50%;
        position: relative;
    }

    &__change-button {
        position: absolute;
        bottom: 0;
        right: 0;
    }
}

.content {
    display: flex;
    flex-direction: column;
    gap: 24px;
    padding: 16px 32px 32px;
}
</style>
