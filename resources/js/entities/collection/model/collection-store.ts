import { computed, ref } from "vue"
import { defineStore } from "pinia"

export const useCollectionStore = defineStore("collection", () => {
    const tracks = ref<string[]>([])
    const tracksCount = ref<number>(0)

    const artists = ref<string[]>([])
    const artistsCount = ref<number>(0)

    const releases = ref<string[]>([])
    const releasesCount = ref<number>(0)

    const getFavoriteTracks = computed(() => tracks.value)
    const getTracksCount = computed(() => tracksCount.value)

    const getFavoriteArtists = computed(() => artists.value)
    const getArtistsCount = computed(() => artistsCount.value)

    const getFavoriteReleases = computed(() => releases.value)
    const getReleasesCount = computed(() => releasesCount.value)

    const addTrack = (id: string) => {
        if (!tracks.value.find(track => track === id)) {
            tracks.value.push(id)
        }
    }

    const addTracks = (value: string[]) => {
        value.forEach(item => addTrack(item))
    }

    const addArtist = (id: string) => {
        if (!artists.value.find(artist => artist === id)) {
            artists.value.push(id)
        }
    }

    const addArtists = (value: string[]) => {
        value.forEach(item => addArtist(item))
    }

    const addRelease = (id: string) => {
        if (!releases.value.find(artist => artist === id)) {
            releases.value.push(id)
        }
    }

    const addReleases = (value: string[]) => {
        value.forEach(item => addRelease(item))
    }

    const setTracksCount = (value: number): void => {
        tracksCount.value = value
    }

    const incrementTracksCount = () => {
        tracksCount.value += 1
    }

    const decrementTracksCount = () => {
        tracksCount.value -= 1
    }

    const setArtistsCount = (value: number): void => {
        artistsCount.value = value
    }

    const incrementArtistsCount = () => {
        artistsCount.value += 1
    }

    const decrementArtistsCount = () => {
        artistsCount.value -= 1
    }

    const setReleasesCount = (value: number): void => {
        releasesCount.value = value
    }

    const incrementReleasesCount = () => {
        releasesCount.value += 1
    }

    const decrementReleasesCount = () => {
        releasesCount.value -= 1
    }


    return {
        getFavoriteTracks,
        getTracksCount,

        getFavoriteArtists,
        getArtistsCount,

        getFavoriteReleases,
        getReleasesCount,

        addTrack,
        addTracks,

        addArtist,
        addArtists,

        addRelease,
        addReleases,

        setTracksCount,
        incrementTracksCount,
        decrementTracksCount,

        setArtistsCount,
        incrementArtistsCount,
        decrementArtistsCount,

        setReleasesCount,
        incrementReleasesCount,
        decrementReleasesCount,
    }
})
