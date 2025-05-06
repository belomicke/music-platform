import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiUser } from "@/shared/api"

export const useUserStore = defineStore("users", () => {
    const users = ref<ApiUser[]>([])

    const getById = computed(() => {
        return (id: string) => {
            return users.value.find(user => user.id === id)
        }
    })

    const addItem = (user: ApiUser) => {
        if (!users.value.find(item => item.id === user.id)) {
            users.value.push(user)
        }
    }

    const follow = (id: string) => {
        const user = users.value.find(item => item.id === id)

        if (!user) return

        user.is_followed = true
        user.followers_count++
    }

    const unfollow = (id: string) => {
        const user = users.value.find(item => item.id === id)

        if (!user) return

        user.is_followed = false
        user.followers_count--
    }

    return {
        getById,

        addItem,

        follow,
        unfollow,
    }
})
