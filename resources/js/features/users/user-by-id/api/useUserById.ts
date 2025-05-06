import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useUserStore } from "@/entities/user"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUserById = (id: ComputedRef<string>) => {
    const userStore = useUserStore()
    const { getById: getUserById } = storeToRefs(userStore)

    const user = computed(() => {
        return getUserById.value(id.value)
    })

    watch(id, async () => {
        if (!user.value) {
            await fetch(id.value)
        }
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
                userStore.addItem(data.data.user)
            }
        },
    })

    return {
        data: user,
        isLoading,
    }
}
