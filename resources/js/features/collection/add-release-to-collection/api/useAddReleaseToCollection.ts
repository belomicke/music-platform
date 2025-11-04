import { ComputedRef } from "vue"
import { useCollectionStore } from "@/entities/collection"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useAddReleaseToCollection = (id: ComputedRef<string>) => {
    const collectionStore = useCollectionStore()

    const releaseStore = useReleaseStore()

    const mutate = async () => {
        releaseStore.follow(id.value)
        collectionStore.addRelease(id.value)
        collectionStore.incrementReleasesCount()

        await follow()
    }

    const { fetch: follow } = useFetch(async () => {
        return await api.collection.addRelease(id.value)
    })

    return {
        mutate,
    }
}
