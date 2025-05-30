import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { useCompactArtistStore } from "@/entities/artist"

export const useArtistReleases = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getMediaListById } = storeToRefs(mediaListStore)

    const releaseStore = useReleaseStore()
    const { getManyById } = storeToRefs(releaseStore)

    const compactArtistStore = useCompactArtistStore()

    const mediaListId = computed(() => {
        return `artist:${id.value}:releases`
    })

    const mediaList = computed(() => {
        return getMediaListById.value(mediaListId.value)
    })

    const data = computed(() => {
        if (!mediaList.value) return []

        return getManyById.value(mediaList.value.items)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return api.artists.getReleases(id.value)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            const releases = data.releases
            const count = data.count

            releaseStore.addItems(releases)

            const artists = releases.map(release => release.artists).flat(1)

            compactArtistStore.addItems(artists)

            mediaListStore.createMediaList({
                id: `artist:${id.value}:releases`,
                items: releases.map(release => release.id),
                count,
            })
        },
    })

    watch(id, async () => {
        if (data.value.length === 0) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (data.value.length === 0) {
            await fetch()
        }
    })

    return {
        data,
        isLoading,
    }
}
