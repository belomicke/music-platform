import { useStickyHeaderStore } from "../model"

export const setStickyHeaderIsMount = (value: boolean) => {
    const stickyHeaderStore = useStickyHeaderStore()

    stickyHeaderStore.setIsMount(value)
}
