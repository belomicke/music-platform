import { onMounted, ref, watch } from "vue"
import { useRoute, useRouter } from "vue-router"

export const useRouterHistory = () => {
    const route = useRoute()
    const router = useRouter()

    const canGoBack = ref<boolean | undefined>(undefined)
    const canGoForward = ref<boolean | undefined>(undefined)

    watch(route, () => {
        getHistoryState()
    })

    onMounted(() => {
        getHistoryState()
    })

    const getHistoryState = () => {
        const back = window.history.state.back
        const forward = window.history.state.forward

        if (back === undefined && forward === undefined) {
            canGoBack.value = false
            canGoForward.value = false
            return
        }

        canGoBack.value = back !== null && back !== undefined
        canGoForward.value = forward !== null && forward !== undefined
    }

    const goBack = () => {
        router.back()
    }

    const goForward = () => {
        router.forward()
    }

    return {
        canGoBack,
        canGoForward,
        goBack,
        goForward,
    }
}
