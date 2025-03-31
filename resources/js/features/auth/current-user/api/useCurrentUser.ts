import { onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useAuthStore } from "@/entities/auth"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { useUserStore } from "@/entities/user"

export const useCurrentUser = () => {
    const authStore = useAuthStore()
    const userStore = useUserStore()
    const { getCurrentUser, getIsAuth } = storeToRefs(authStore)

    const { fetch, isLoading } = useFetch(async () => {
        return api.auth.me()
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            authStore.setIsAuth(data.user !== null)
            authStore.setCurrentUser(data.user)

            userStore.addUser(data.user)

            localStorage.setItem("user", JSON.stringify(data.user))
        },
        onError: (error) => {
            if (error.response.status === 401) {
                authStore.setIsAuth(false)
                localStorage.removeItem("user")
            }
        },
    })

    onMounted(async () => {
        if (isLoading.value) return
        if (getCurrentUser.value !== undefined) return
        if (getIsAuth.value === false) return

        await fetch()
    })

    return {
        user: getCurrentUser,
        isAuth: getIsAuth,
        isLoading,
    }
}
