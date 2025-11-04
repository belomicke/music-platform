import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCurrentUser } from "@/features/auth/current-user"
import { useCollectionStore } from "@/entities/collection"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { useTrackStore } from "@/entities/track"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useCollection = () => {
    const trackStore = useTrackStore()
    const artistStore = useArtistStore()
    const releaseStore = useReleaseStore()

    const collectionStore = useCollectionStore()

    const { getSeveralTracks } = storeToRefs(trackStore)
    const { getSeveralArtists } = storeToRefs(artistStore)
    const { getSeveralReleases } = storeToRefs(releaseStore)

    const {
        getFavoriteTracks,
        getTracksCount,
        getFavoriteArtists,
        getArtistsCount,
        getFavoriteReleases,
        getReleasesCount,
    } = storeToRefs(collectionStore)

    const { data: user } = useCurrentUser()

    const tracks = computed(() => {
        return {
            items: getSeveralTracks.value(getFavoriteTracks.value),
            count: getTracksCount.value,
        }
    })

    const artists = computed(() => {
        return {
            items: getSeveralArtists.value(getFavoriteArtists.value),
            count: getArtistsCount.value,
        }
    })

    const releases = computed(() => {
        return {
            items: getSeveralReleases.value(getFavoriteReleases.value),
            count: getReleasesCount.value,
        }
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
            const tracksList = data.data.data.tracks
            const artistList = data.data.data.artists
            const releasesList = data.data.data.releases

            trackStore.addItems(tracksList.items)
            artistStore.addItems(artistList.items)
            releaseStore.addItems(releasesList.items)

            collectionStore.addTracks(tracksList.items.map(track => track.id))
            collectionStore.setTracksCount(tracksList.count)

            collectionStore.addArtists(artistList.items.map(artist => artist.id))
            collectionStore.setArtistsCount(artistList.count)

            collectionStore.addReleases(releasesList.items.map(release => release.id))
            collectionStore.setReleasesCount(releasesList.count)
        },
    })

    onMounted(async () => {
        if (user.value.favorite_artists_count !== data.value.artists.count) {
            await fetch()
        } else if (user.value.favorite_releases_count !== data.value.releases.count) {
            await fetch()
        } else if (user.value.favorite_tracks_count !== data.value.tracks.count) {
            await fetch()
        }
    })

    return {
        data,
        fetch,
        isLoading,
    }
}
