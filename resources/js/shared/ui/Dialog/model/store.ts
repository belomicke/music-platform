import { computed, ref } from "vue"
import { defineStore } from "pinia"
import type { CreateDialogDTO, Dialog } from "../types"

export const useDialogStore = defineStore("dialog", () => {
    const dialogs = ref<Dialog[]>([])
    let seed = 1

    const getDialogs = computed(() => {
        return dialogs.value
    })

    const addDialog = (dialog: CreateDialogDTO) => {
        dialogs.value.push({
            id: seed++,
            ...dialog,
        })
    }

    const closeDialog = (id: number) => {
        dialogs.value = dialogs.value.filter(dialog => dialog.id !== id)
    }

    return {
        getDialogs,
        addDialog,
        closeDialog,
    }
})
