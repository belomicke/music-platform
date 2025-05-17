import { useCompactArtistStore } from "@/entities/artist"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { computed } from "vue"
import { storeToRefs } from "pinia"

export const useCollection = () => {
    const releaseStore = useReleaseStore()
    const mediaListStore = useMediaListStore()
    const compactArtistStore = useCompactArtistStore()

    const {
        getMediaListById,
        getFavoriteArtistsMediaListId,
        getFavoriteReleasesMediaListId,
    } = storeToRefs(mediaListStore)

    const artistsMediaListId = computed(() => {
        return getFavoriteArtistsMediaListId.value
    })

    const releasesMediaListId = computed(() => {
        return getFavoriteReleasesMediaListId.value
    })

    const artists = computed(() => {
        return getMediaListById.value(artistsMediaListId.value)
    })

    const releases = computed(() => {
        return getMediaListById.value(releasesMediaListId.value)
    })

    const data = computed(() => {
        if (artists.value === undefined || releases.value === undefined) return undefined

        return {
            artists: artists.value,
            releases: releases.value,
        }
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.collection.get()
    }, {
        onSuccess: (data) => {
            const artistList = data.data.data.artists
            const releasesList = data.data.data.releases

            releaseStore.addItems(releasesList.items)
            compactArtistStore.addItems(artistList.items)

            mediaListStore.createMediaList({
                id: mediaListStore.getFavoriteArtistsMediaListId,
                items: artistList.items.map(item => item.id),
                count: artistList.count,
            })

            mediaListStore.createMediaList({
                id: mediaListStore.getFavoriteReleasesMediaListId,
                items: releasesList.items.map(item => item.id),
                count: releasesList.count,
            })
        },
    })

    return {
        data,
        fetch,
        isLoading,
    }
}
