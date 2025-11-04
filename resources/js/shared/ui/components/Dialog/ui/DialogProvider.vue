<script setup lang="ts">
import { storeToRefs } from "pinia"
import IDialog from "./IDialog.vue"
import { useDialogStore } from "../model"

const dialogStore = useDialogStore()
const { getDialogs } = storeToRefs(dialogStore)
</script>

<template>
    <slot></slot>
    <Teleport to="#portals">
        <i-dialog
            :dialog="dialog"

            v-for="dialog in getDialogs"
            :key="dialog.id"

            @submit="dialog.onConfirm"
            @close="dialogStore.closeDialog(dialog.id)"
        />
    </Teleport>
</template>
