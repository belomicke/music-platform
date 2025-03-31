import { useFetch } from "@/shared/hooks"
import { api, ResetPasswordDTO, StatusResponse } from "@/shared/api"
import { UseFetchOptions } from "@/shared/hooks/useFetch"

export const useResetPassword = (options: UseFetchOptions<StatusResponse> = {}) => {
    return useFetch(async (data: ResetPasswordDTO) => {
        return await api.auth.resetPassword(data)
    }, options)
}
