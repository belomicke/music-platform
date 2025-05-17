import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUnfollowRelease = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.releases.unfollow(id.value)
    })
}
