import { ref } from "vue"
import { ApiErrorResponse } from "@/shared/api/responses"

export type UseFetchOptions<Response, Params> = {
    onSuccess?: (res: Response, params: Params) => void
    onError?: (data: ApiErrorResponse) => void
}

export const useFetch = <Params = {}, Response = {}>(
    callback: (params: Params) => Promise<Response>,
    options: UseFetchOptions<Response, Params> = {},
) => {
    const isLoading = ref<boolean>(false)

    const fetch = async (params?: Params) => {
        if (isLoading.value) return

        isLoading.value = true

        callback(params).then(res => {
            if (typeof options.onSuccess === "function") {
                options.onSuccess(res, params)
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
