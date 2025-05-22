import { useCompactArtistStore } from "@/entities/artist"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useTrackStore } from "@/entities/track"

export const useCollection = () => {
    const trackStore = useTrackStore()
    const releaseStore = useReleaseStore()
    const mediaListStore = useMediaListStore()
    const compactArtistStore = useCompactArtistStore()

    const {
        getMediaListById,
        getFavoriteArtistsMediaListId,
        getFavoriteReleasesMediaListId,
        getFavoriteTracksMediaListId,
    } = storeToRefs(mediaListStore)

    const artistsMediaListId = computed(() => {
        return getFavoriteArtistsMediaListId.value
    })

    const releasesMediaListId = computed(() => {
        return getFavoriteReleasesMediaListId.value
    })

    const tracksMediaListId = computed(() => {
        return getFavoriteTracksMediaListId.value
    })

    const artists = computed(() => {
        return getMediaListById.value(artistsMediaListId.value)
    })

    const releases = computed(() => {
        return getMediaListById.value(releasesMediaListId.value)
    })

    const tracks = computed(() => {
        return getMediaListById.value(tracksMediaListId.value)
    })

    const data = computed(() => {
        if (
            artists.value === undefined ||
            releases.value === undefined ||
            tracks.value === undefined
        ) return undefined

        return {
            artists: artists.value,
            releases: releases.value,
            tracks: tracks.value,
        }
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.collection.get()
    }, {
        onSuccess: (data) => {
            const artistList = data.data.data.artists
            const releasesList = data.data.data.releases
            const tracksList = data.data.data.tracks

            releaseStore.addItems(releasesList.items)
            compactArtistStore.addItems(artistList.items)
            trackStore.addItems(tracksList.items)

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

            mediaListStore.createMediaList({
                id: mediaListStore.getFavoriteTracksMediaListId,
                items: tracksList.items.map(item => item.id),
                count: tracksList.count,
            })
        },
    })

    return {
        data,
        fetch,
        isLoading,
    }
}
