import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useArtistStore } from "@/entities/artist"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useArtistById = (id: ComputedRef<string>) => {
    const artistStore = useArtistStore()
    const { getById: getArtistById } = storeToRefs(artistStore)

    const artist = computed(() => {
        return getArtistById.value(id.value)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.getById(id.value)
    }, {
        onSuccess: (res) => {
            artistStore.addItem(res.data.data.artist)
        },
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
