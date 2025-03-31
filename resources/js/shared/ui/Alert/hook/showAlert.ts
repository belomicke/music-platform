import { useAlertStore } from "../store"
import type { CreateAlertDTO } from "../types"

export const showAlert = (data: CreateAlertDTO) => {
    useAlertStore().addAlert(data)
}
