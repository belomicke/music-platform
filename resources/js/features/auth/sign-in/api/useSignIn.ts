import { useFetch } from "@/shared/hooks"
import type { CurrentUserResponse, SignInDTO } from "@/shared/api"
import { api } from "@/shared/api"
import { UseFetchOptions } from "@/shared/hooks/useFetch"

export const useSignIn = (options: UseFetchOptions<CurrentUserResponse>) => {
    return useFetch(async (data: SignInDTO) => {
        return api.auth.login(data)
    }, {
        onSuccess: (res) => {
            localStorage.setItem("user", JSON.stringify(res.data.data.user))
            window.location.reload()
        },
        ...options,
    })
}
