import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useArtistStore } from "@/entities/artist"
import { HookOptions, useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useArtistById = (id: ComputedRef<string>, options?: HookOptions) => {
    const artistStore = useArtistStore()
    const { getArtistById } = storeToRefs(artistStore)

    const artist = computed(() => {
        return getArtistById.value(id.value)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.getById(id.value)
    }, {
        onSuccess: (res) => {
            const artist = res.data.data.artist

            artistStore.addItem(artist)
        },
        onError: (err) => {
            if (options && typeof options.onError === "function") {
                options.onError(err)
            }
        },
    })

    watch(id, async () => {
        if (artist.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (artist.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    return {
        data: artist,
        fetch,
        isLoading,
    }
}
