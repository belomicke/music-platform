import { computed, ref } from "vue"
import { defineStore } from "pinia"

export const useStickyHeaderStore = defineStore("sticky-header", () => {
    const title = ref<string>("")

    const getTitle = computed(() => title.value)

    const setTitle = (value: string) => title.value = value

    return {
        getTitle,
        setTitle,
    }
})
