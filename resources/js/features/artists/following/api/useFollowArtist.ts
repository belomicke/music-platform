import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFollowArtist = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.artists.follow(id.value)
    })
}
