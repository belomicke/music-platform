import { useStickyHeaderStore } from "../model"

export const setStickyHeaderTitle = (value: string) => {
    const stickyHeaderStore = useStickyHeaderStore()

    stickyHeaderStore.setTitle(value)
}
