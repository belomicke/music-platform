import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiUser } from "@/shared/api"

export const useUserStore = defineStore("users", () => {
    const users = ref<ApiUser[]>([])

    const getUserById = computed(() => {
        return (id: string) => {
            return users.value.find(user => user.id === id)
        }
    })

    const addUser = (user: ApiUser) => {
        if (!users.value.find(item => item.id === user.id)) {
            users.value.push(user)
        }
    }

    return {
        getUserById,

        addUser,
    }
})
