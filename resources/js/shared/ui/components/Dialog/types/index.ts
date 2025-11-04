export interface CreateDialogDTO {
    title: string
    message: string
    confirmButtonText?: string
    onConfirm?: () => void
    onClose?: () => void
}

export interface Dialog extends CreateDialogDTO {
    id: number
}
