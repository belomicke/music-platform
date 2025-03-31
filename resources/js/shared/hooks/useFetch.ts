import { ref } from "vue"
import { ApiErrorResponse } from "@/shared/api/responses"

export type UseFetchOptions<S> = {
    onSuccess?: (res: S) => void
    onError?: (data: ApiErrorResponse) => void
}

export const useFetch = <T, S = {}>(
    callback: (params: S) => Promise<T>,
    options: UseFetchOptions<T> = {},
) => {
    const isLoading = ref<boolean>(false)

    const fetch = async (params?: S) => {
        if (isLoading.value) return

        isLoading.value = true

        callback(params).then(res => {
            if (typeof options.onSuccess === "function") {
                options.onSuccess(res)
            }
        }).catch((error) => {
            if (typeof options.onError === "function") {
                options.onError(error)
            }
        }).finally(() => {
            isLoading.value = false
        })
    }

    return {
        fetch,
        isLoading,
    }
}
