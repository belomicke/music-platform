import { useDialogStore } from "../model"
import type { CreateDialogDTO } from "../types"

export const createDialog = (data: CreateDialogDTO) => {
    useDialogStore().addDialog(data)
}
