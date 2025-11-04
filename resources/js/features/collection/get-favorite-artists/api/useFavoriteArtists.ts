import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCurrentUser } from "@/features/auth/current-user"
import { useCollectionStore } from "@/entities/collection"
import { useArtistStore } from "@/entities/artist"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteArtists = () => {
    const artistStore = useArtistStore()
    const { getSeveralArtists } = storeToRefs(artistStore)

    const collectionStore = useCollectionStore()
    const { getFavoriteArtists, getArtistsCount } = storeToRefs(collectionStore)

    const { data: user } = useCurrentUser()

    const artists = computed(() => {
        return getSeveralArtists.value(getFavoriteArtists.value)
    })

    const count = computed(() => {
        return getArtistsCount.value
    })

    const hasMore = computed((): boolean => {
        return artists.value.length < count.value
    })

    const after = computed(() => {
        if (artists.value.length === 0) return ""

        return artists.value.at(-1).id
    })

    const { fetch, isLoading } = useFetch(async (after: string = "") => {
        return await api.collection.getFavoriteArtists(after)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            artistStore.addItems(data.artists)

            collectionStore.addArtists(data.artists.map(artist => artist.id))
            collectionStore.setArtistsCount(data.count)
        },
    })

    onMounted(async () => {
        if (user.value.favorite_artists_count !== getArtistsCount.value) {
            await fetch(after.value)
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch(after.value)
    }

    return {
        data: artists,
        isLoading,
        hasMore,
        getMore,
    }
}
