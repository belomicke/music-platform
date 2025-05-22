import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useMediaListStore } from "@/entities/media-list"
import { useCompactArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useTrackStore } from "@/entities/track"
import { api, type ApiCompactArtist, ApiRelease, ApiTrack, SearchType } from "@/shared/api"
import { useFetch } from "@/shared/hooks"

export const useSearch = (
    query: ComputedRef<string>,
    type: ComputedRef<SearchType>,
    bestResults: ComputedRef<boolean>,
) => {
    const mediaListStore = useMediaListStore()
    const compactArtistStore = useCompactArtistStore()
    const releaseStore = useReleaseStore()
    const trackStore = useTrackStore()

    const { getMediaListById } = storeToRefs(mediaListStore)
    const { getManyById: getManyArtistsById } = storeToRefs(compactArtistStore)
    const { getManyById: getManyReleasesById } = storeToRefs(releaseStore)
    const { getManyById: getManyTracksById } = storeToRefs(trackStore)

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

    const releasesMediaListId = computed(() => {
        return `search:${query.value}:releases`
    })

    const releasesMediaList = computed(() => {
        return getMediaListById.value(releasesMediaListId.value)
    })

    const releases = computed(() => {
        if (!releasesMediaList.value) return undefined

        return getManyReleasesById.value(releasesMediaList.value.items)
    })

    const tracksMediaListId = computed(() => {
        return `search:${query.value}:tracks`
    })

    const tracksMediaList = computed(() => {
        return getMediaListById.value(tracksMediaListId.value)
    })

    const tracks = computed(() => {
        if (!tracksMediaList.value) return undefined

        return getManyTracksById.value(tracksMediaList.value.items)
    })

    const data = computed(() => {
        return {
            artists: artists.value ?? [],
            releases: releases.value ?? [],
            tracks: tracks.value ?? [],
        }
    })

    const noResults = computed(() => {
        if (artists.value === undefined) return undefined
        if (releases.value === undefined) return undefined
        if (tracks.value === undefined) return undefined

        return artists.value.length === 0 &&
            releases.value.length === 0 &&
            tracks.value.length === 0
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.search.search(query.value, type.value, bestResults.value)
    }, {
        onSuccess: (data) => {
            handleArtistsFromResponse(data.data.data.artists)
            handleReleasesFromResponse(data.data.data.releases)
            handleTracksFromResponse(data.data.data.tracks)
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

    const handleReleasesFromResponse = (releases: ApiRelease[]) => {
        releaseStore.addItems(releases)

        const dto = {
            id: releasesMediaListId.value,
            items: releases.map(release => release.id),
            count: releases.length,
        }

        if (artistsMediaList.value === undefined) {
            mediaListStore.createMediaList(dto)
        } else {
            mediaListStore.addItemsToMediaList(dto)
        }
    }

    const handleTracksFromResponse = (tracks: ApiTrack[]) => {
        trackStore.addItems(tracks)

        const dto = {
            id: tracksMediaListId.value,
            items: tracks.map(track => track.id),
            count: tracks.length,
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
