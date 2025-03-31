import { useFetch } from "@/shared/hooks"
import { api, StatusResponse } from "@/shared/api"
import { UseFetchOptions } from "@/shared/hooks/useFetch"

export const useForgotPassword = (options: UseFetchOptions<StatusResponse> = {}) => {
    return useFetch(async (email: string) => {
        return await api.auth.forgotPassword(email)
    }, options)
}
