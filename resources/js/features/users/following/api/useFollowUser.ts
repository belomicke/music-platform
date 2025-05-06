import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFollowUser = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.me.followUser(id.value)
    })
}
