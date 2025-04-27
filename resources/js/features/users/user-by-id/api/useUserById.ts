import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useUserStore } from "@/entities/user"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUserById = (id: ComputedRef<string>) => {
    const userStore = useUserStore()
    const { getUserById } = storeToRefs(userStore)

    const user = computed(() => {
        return getUserById.value(id.value)
    })

    onMounted(async () => {
        if (!user.value) {
            await fetch(id.value)
        }
    })

    const { fetch, isLoading } = useFetch(async (id: string) => {
        return await api.users.getById(id)
    }, {
        onSuccess: (res) => {
            const data = res.data

            if (data.success) {
                userStore.addUser(data.data.user)
            }
        },
    })

    return {
        user,
        isLoading,
    }
}
