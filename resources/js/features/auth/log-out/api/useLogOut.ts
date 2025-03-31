import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useLogOut = () => {
    return useFetch(async () => {
        return await api.auth.logout()
    }, {
        onSuccess: (res) => {
            if (res.data.success) {
                localStorage.removeItem("user")
                window.location.reload()
            }
        },
    })
}
