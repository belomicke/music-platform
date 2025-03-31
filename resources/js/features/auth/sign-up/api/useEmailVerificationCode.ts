import { useFetch } from "@/shared/hooks"
import { api, StatusResponse } from "@/shared/api"
import type { UseFetchOptions } from "@/shared/hooks/useFetch"

export const useEmailVerificationCode = (options: UseFetchOptions<StatusResponse> = {}) => {
    return useFetch(async (email: string) => {
        return await api.auth.sendEmailVerificationMail(email)
    }, options)
}

