import { onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useAuthStore } from "@/entities/auth"
import { useCompactUserStore, useUserStore } from "@/entities/user"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useCurrentUser = () => {
    const authStore = useAuthStore()
    const userStore = useUserStore()
    const compactUserStore = useCompactUserStore()
    const { getCurrentUser, getIsAuth } = storeToRefs(authStore)

    const { fetch, isLoading } = useFetch(async () => {
        return api.me.get()
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            authStore.setIsAuth(data.user !== null)
            authStore.setCurrentUser(data.user)

            userStore.addItem(data.user)
            compactUserStore.addItem({
                id: data.user.id,
                name: data.user.id,
                image_url: data.user.image_url,
                is_followed: false,
            })

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
        data: getCurrentUser,
        isAuth: getIsAuth,
        isLoading,
    }
}
