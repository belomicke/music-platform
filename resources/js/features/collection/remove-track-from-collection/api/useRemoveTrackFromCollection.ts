import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { useFetch, UseFetchOptions } from "@/shared/hooks"
import { api, StatusResponse } from "@/shared/api"

export const useRemoveTrackFromCollection = (id: ComputedRef<string>, options: UseFetchOptions<StatusResponse> = {}) => {
    const collectionStore = useCollectionStore()

    const { fetch: removeFromCollection } = useFetch(async () => {
        return await api.collection.removeTrack(id.value)
    }, options)

    const mutate = async () => {
        collectionStore.decrementTracksCount()

        await removeFromCollection()
    }

    return {
        mutate,
    }
}
