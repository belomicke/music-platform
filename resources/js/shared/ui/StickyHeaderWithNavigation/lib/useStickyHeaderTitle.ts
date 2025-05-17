import { ComputedRef, onMounted, onUnmounted, ref, watch } from "vue"
import { storeToRefs } from "pinia"
import { useStickyHeaderStore } from "../model"

export const useStickyHeaderTitle = (text: ComputedRef<string>) => {
    const stickyHeaderStore = useStickyHeaderStore()
    const { getTitle } = storeToRefs(stickyHeaderStore)

    const prevTitle = ref<string>("")

    watch(text, () => {
        stickyHeaderStore.setTitle(text.value)
    })

    onMounted(() => {
        prevTitle.value = getTitle.value
        stickyHeaderStore.setTitle(text.value)
    })

    onUnmounted(() => {
        stickyHeaderStore.setTitle(prevTitle.value)
    })
}
