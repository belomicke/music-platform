import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useArtistReleaseListStore } from "@/entities/artist-releases"
import { useReleaseStore } from "@/entities/release"
import { useArtistStore } from "@/entities/artist"
import { HookOptions, useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useArtistReleases = (id: ComputedRef<string>, options?: HookOptions) => {
    const releaseStore = useReleaseStore()
    const { getSeveralReleases } = storeToRefs(releaseStore)

    const artistStore = useArtistStore()
    const artistReleasesStore = useArtistReleaseListStore()

    const artistsReleasesList = computed(() => {
        return artistReleasesStore.getArtistReleases(id.value)
    })

    const releases = computed(() => {
        if (artistsReleasesList.value === undefined) return []

        return getSeveralReleases.value(artistsReleasesList.value.releases)
    })

    const count = computed(() => {
        if (artistsReleasesList.value === undefined) return 0

        return artistsReleasesList.value.count
    })

    const hasMore = computed(() => {
        if (artistsReleasesList.value === undefined) return false

        return artistsReleasesList.value.releases.length < count.value
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.artists.getReleases(id.value)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            const releases = data.releases
            const artists = releases.map(release => release.artists).flat(1)
            const count = data.count

            artistStore.addItems(artists)
            releaseStore.addItems(releases)

            artistReleasesStore.addArtistReleases({
                id: id.value,
                releases: releases.map(release => release.id),
                count: count,
            })
        },
        onError: (error) => {
            if (options && typeof options["onError"] === "function") {
                options.onError(error)
            }
        },
    })

    watch(id, async () => {
        if (artistsReleasesList.value === undefined) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (artistsReleasesList.value === undefined) {
            await fetch()
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch()
    }

    return {
        releases,
        count,
        hasMore,
        isLoading,
        getMore,
    }
}
