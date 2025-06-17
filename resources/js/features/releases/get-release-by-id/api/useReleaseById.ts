import { computed, ComputedRef, onMounted, watch } from "vue"
import { AxiosError } from "axios"
import { storeToRefs } from "pinia"
import { useArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

interface Options {
    onError: (err: AxiosError) => void
}

export const useReleaseById = (id: ComputedRef<string>, options?: Options) => {
    const releaseStore = useReleaseStore()
    const artistStore = useArtistStore()
    const { getById: getReleaseById } = storeToRefs(releaseStore)

    const release = computed(() => {
        return getReleaseById.value(id.value)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.releases.getById(id.value)
    }, {
        onSuccess: (res) => {
            const release = res.data.data.release
            const artists = release.artists

            artistStore.addItems(artists)

            releaseStore.addItem(release)
        },
        onError: (err) => {
            if (options && typeof options.onError === "function") {
                options.onError(err)
            }
        },
    })

    watch(id, async () => {
        if (release.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (release.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    return {
        data: release,
        fetch,
        isLoading,
    }
}
