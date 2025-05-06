import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUnfollowArtist = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.me.unfollowArtist(id.value)
    })
}
