import { useFetch } from "@/shared/hooks"
import { api, type CreateUserDTO } from "@/shared/api"

export const useCreateUser = () => {
    return useFetch(async (data: CreateUserDTO) => {
        return api.auth.createUser(data)
    }, {
        onSuccess: (res) => {
            localStorage.setItem("user", JSON.stringify(res.data.data.user))
            window.location.reload()
        },
    })
}
