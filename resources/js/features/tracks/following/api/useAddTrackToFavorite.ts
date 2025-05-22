import { ComputedRef } from "vue"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useAddTrackToFavorite = (id: ComputedRef<string>) => {
    return useFetch(async () => {
        return await api.tracks.addToFavorite(id.value)
    })
}
