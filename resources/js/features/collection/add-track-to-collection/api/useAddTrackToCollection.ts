import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { api, type StatusResponse } from "@/shared/api"
import { useFetch, UseFetchOptions } from "@/shared/hooks"

export const useAddTrackToCollection = (id: ComputedRef<string>, options: UseFetchOptions<StatusResponse> = {}) => {
    const collectionStore = useCollectionStore()

    const { fetch: addToCollection } = useFetch(async () => {
        return await api.collection.addTrack(id.value)
    }, options)

    const mutate = async () => {
        collectionStore.addTrack(id.value)
        collectionStore.incrementTracksCount()

        await addToCollection()
    }

    return {
        mutate,
    }
}
