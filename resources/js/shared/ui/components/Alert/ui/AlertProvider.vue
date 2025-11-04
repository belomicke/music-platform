<script setup lang="ts">
import { storeToRefs } from "pinia"
import IAlert from "./IAlert.vue"
import { useAlertStore } from "../store"

const alertStore = useAlertStore()
const { getAlerts } = storeToRefs(alertStore)
</script>

<template>
    <slot></slot>
    <Teleport to="#portals">
        <i-alert
            class="alert-provider__alert"
            :alert="alert"
            :style="{
                'transform': `translate(-50%, calc(${index > 0 ? index + '* 100% + 10px' : index + '* 100%'}))`
            }"
            v-for="(alert, index) in getAlerts"
            :key="alert.id"
            @close="alertStore.deleteAlert(alert.id)"
        />
    </Teleport>
</template>

<style lang="scss">
.alert-provider__alert {
    position: absolute;
    top: 10px;
    left: 50%;
    max-width: 465px;
}
</style>
