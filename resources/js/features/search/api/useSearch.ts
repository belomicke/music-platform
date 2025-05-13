import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { SearchType } from "../types"
import { useMediaListStore } from "@/entities/media-list"
import { useCompactArtistStore } from "@/entities/artist"
import { api, type ApiCompactArtist } from "@/shared/api"
import { useFetch } from "@/shared/hooks"

export const useSearch = (
    query: ComputedRef<string>,
    type: ComputedRef<SearchType>,
    bestResults: ComputedRef<boolean>,
) => {
    const mediaListStore = useMediaListStore()
    const compactArtistStore = useCompactArtistStore()

    const { getMediaListById } = storeToRefs(mediaListStore)
    const { getManyById: getManyArtistsById } = storeToRefs(compactArtistStore)

    const artistsMediaListId = computed(() => {
        return `search:${query.value}:artists`
    })

    const artistsMediaList = computed(() => {
        return getMediaListById.value(artistsMediaListId.value)
    })

    const artists = computed(() => {
        if (!artistsMediaList.value) return undefined

        return getManyArtistsById.value(artistsMediaList.value.items)
    })

    const data = computed(() => {
        return {
            artists: artists.value ?? [],
        }
    })

    const noResults = computed(() => {
        if (artists.value === undefined) return undefined

        return artists.value.length === 0
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.search(query.value, type.value, bestResults.value)
    }, {
        onSuccess: (data) => {
            handleArtistsFromResponse(data.data.data.artists)
        },
    })

    watch(query, async () => {
        if (query.value.length && artists.value === undefined) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (query.value.length && artists.value === undefined) {
            await fetch()
        }
    })

    const handleArtistsFromResponse = (artists: ApiCompactArtist[]) => {
        compactArtistStore.addItems(artists)

        const dto = {
            id: artistsMediaListId.value,
            items: artists.map(artist => artist.id),
            count: artists.length,
        }

        if (artistsMediaList.value === undefined) {
            mediaListStore.createMediaList(dto)
        } else {
            mediaListStore.addItemsToMediaList(dto)
        }
    }

    return {
        data,
        noResults,
        isLoading,
    }
}
