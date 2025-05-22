import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useRemoveTrackFromFavorite = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.tracks.removeFromFavorite(id.value)
    })
}
