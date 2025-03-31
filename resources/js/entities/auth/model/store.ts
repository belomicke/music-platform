import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ICurrentUser } from "@/shared/api"

export const useAuthStore = defineStore("auth", () => {
    const user = ref<ICurrentUser | undefined>(undefined)
    const isAuth = ref<boolean | undefined>(localStorage.getItem("user") !== null)

    const getCurrentUser = computed(() => {
        return user.value
    })

    const getIsAuth = computed(() => {
        return isAuth.value
    })

    const setCurrentUser = (value: ICurrentUser) => {
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
