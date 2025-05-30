import { computed, ref } from "vue"
import { defineStore } from "pinia"

export const useStickyHeaderStore = defineStore("sticky-header", () => {
    const title = ref<string>("")
    const isMount = ref<boolean>(true)

    const getTitle = computed(() => title.value)
    const getIsMount = computed(() => isMount.value)

    const setTitle = (value: string) => title.value = value

    const setIsMount = (value: boolean) => isMount.value = value

    return {
        getTitle,
        getIsMount,

        setTitle,
        setIsMount,
    }
})
