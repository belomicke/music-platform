import { computed, ref } from "vue"
import { defineStore } from "pinia"
import type { Alert, CreateAlertDTO } from "../types"

export const useAlertStore = defineStore("alerts", () => {
    let seed = 1

    const alerts = ref<Alert[]>([])

    const getAlerts = computed(() => {
        return alerts.value
    })

    const addAlert = (data: CreateAlertDTO) => {
        alerts.value.push({
            id: seed++,
            text: data.text,
            type: data.type,
            center: data.center ?? false,
            duration: data.duration ?? 5000,
        })

        if (alerts.value.length === 11) {
            deleteOldestAlert()
        }
    }

    const deleteAlert = (value: number) => {
        if (!alerts.value.find(alert => alert.id === value)) return

        alerts.value = alerts.value.filter(alert => alert.id !== value)
    }

    const deleteOldestAlert = () => {
        alerts.value.splice(0, 1)
    }

    return {
        getAlerts,
        addAlert,
        deleteAlert,
        deleteOldestAlert,
    }
})
