import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiCurrentUser } from "@/shared/api"

export const useAuthStore = defineStore("auth", () => {
    const user = ref<ApiCurrentUser | undefined>(undefined)
    const isAuth = ref<boolean | undefined>(localStorage.getItem("user") !== null)

    const getCurrentUser = computed(() => {
        return user.value
    })

    const getIsAuth = computed(() => {
        return isAuth.value
    })

    const setCurrentUser = (value: ApiCurrentUser) => {
        user.value = value
    }

    const setIsAuth = (value: boolean) => {
        isAuth.value = value
    }

    return {
        getCurrentUser,
        getIsAuth,

        setCurrentUser,
        setIsAuth,
    }
})
