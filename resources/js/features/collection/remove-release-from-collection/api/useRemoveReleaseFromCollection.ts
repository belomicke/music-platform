import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useRemoveReleaseFromCollection = (id: ComputedRef<string>) => {
    const collectionStore = useCollectionStore()

    const releaseStore = useReleaseStore()

    const mutate = async () => {
        releaseStore.unfollow(id.value)
        collectionStore.decrementReleasesCount()

        await follow()
    }

    const { fetch: follow } = useFetch(async () => {
        return await api.collection.removeRelease(id.value)
    })

    return {
        mutate,
    }
}
