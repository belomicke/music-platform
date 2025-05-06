import { computed, ComputedRef } from "vue"
import { storeToRefs } from "pinia"
import { useMediaListStore } from "@/entities/media-list"

export const useMediaList = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getMediaListById } = storeToRefs(mediaListStore)

    const data = computed(() => {
        return getMediaListById.value(id.value)
    })

    const hasMore = computed((): boolean | undefined => {
        if (data.value === undefined) return undefined

        return data.value.items.length < data.value.count
    })

    return {
        data,
        hasMore,
    }
}
