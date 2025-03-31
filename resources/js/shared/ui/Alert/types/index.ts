export type AlertType = "success" | "info" | "warning" | "error"

export interface Alert {
    id: number
    text: string
    center: boolean
    duration: number
    type: AlertType
}

export interface CreateAlertDTO {
    text: string
    center?: boolean
    duration?: number
    type: AlertType
}
