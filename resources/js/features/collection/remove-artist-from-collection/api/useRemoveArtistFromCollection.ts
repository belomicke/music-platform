import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { useArtistStore } from "@/entities/artist"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useRemoveArtistFromCollection = (id: ComputedRef<string>) => {
    const collectionStore = useCollectionStore()

    const artistStore = useArtistStore()

    const mutate = async () => {
        artistStore.unfollow(id.value)
        collectionStore.decrementArtistsCount()

        await removeFromCollection()
    }

    const { fetch: removeFromCollection } = useFetch(async () => {
        return await api.collection.removeArtist(id.value)
    })

    return {
        mutate,
    }
}
