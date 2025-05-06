import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiCompactUser } from "@/shared/api"

export const useCompactUserStore = defineStore("compact-users", () => {
    const users = ref<ApiCompactUser[]>([])

    const getById = computed(() => {
        return (id: string): ApiCompactUser | undefined => {
            return users.value.find(user => user.id === id)
        }
    })

    const getManyById = computed(() => {
        return (ids: string[]): ApiCompactUser[] | undefined => {
            const result: ApiCompactUser[] = []

            ids.forEach(id => {
                result.push(users.value.find(user => user.id === id))
            })

            return result
        }
    })

    const addItem = (user: ApiCompactUser) => {
        if (getById.value(user.id) === undefined) {
            users.value.push(user)
        }
    }

    const addItems = (value: ApiCompactUser[]) => {
        value.forEach(item => addItem(item))
    }

    const follow = (id: string) => {
        const user = users.value.find(item => item.id === id)

        if (!user) return

        user.is_followed = true
    }

    const unfollow = (id: string) => {
        const user = users.value.find(item => item.id === id)

        if (!user) return

        user.is_followed = false
    }

    return {
        getById,
        getManyById,

        addItem,
        addItems,

        follow,
        unfollow,
    }
})
