import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUnfollowUser = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.me.unfollowUser(id.value)
    })
}
