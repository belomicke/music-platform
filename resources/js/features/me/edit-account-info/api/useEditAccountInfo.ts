import { useAuthStore } from "@/entities/auth"
import { api, type EditAccountInfoDTO } from "@/shared/api"
import { useFetch } from "@/shared/hooks"

export const useEditAccountInfo = () => {
    const authStore = useAuthStore()

    return useFetch(async (data: EditAccountInfoDTO) => {
        const formData = new FormData()

        if (data.name) {
            formData.append("name", data.name)
        }

        if (data.avatar) {
            formData.append("avatar", data.avatar)
        }

        return api.me.editAccountInfo(formData)
    }, {
        onSuccess: (data) => {
            authStore.setCurrentUser(data.data.data.user)
        },
    })
}
