import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { useArtistStore } from "@/entities/artist"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useAddArtistToCollection = (id: ComputedRef<string>) => {
    const collectionStore = useCollectionStore()

    const artistStore = useArtistStore()

    const mutate = async () => {
        artistStore.follow(id.value)
        collectionStore.addArtist(id.value)
        collectionStore.incrementArtistsCount()

        await addToCollection()
    }

    const { fetch: addToCollection } = useFetch(async () => {
        return await api.collection.addArtist(id.value)
    })

    return {
        mutate,
    }
}
