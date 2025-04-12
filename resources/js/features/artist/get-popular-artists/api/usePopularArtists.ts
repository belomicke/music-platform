import { onMounted, ref } from "vue"
import { useArtistStore } from "@/entities/artist"
import { useFetch } from "@/shared/hooks"
import { api, IArtist } from "@/shared/api"

export const usePopularArtists = () => {
    const artists = ref<IArtist[]>([])

    const artistStore = useArtistStore()

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.popular()
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            artists.value = data.artists

            data.artists.forEach(artist => artistStore.addArtist(artist))
        },
    })

    onMounted(async () => {
        await fetch()
    })

    return {
        data: artists,
        isLoading,
    }
}
