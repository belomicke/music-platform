import { computed, ComputedRef, onMounted, watch } from "vue"
import { AxiosError } from "axios"
import { storeToRefs } from "pinia"
import { useArtistStore } from "@/entities/artist"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

interface Options {
    onError: (err: AxiosError) => void
}

export const useArtistById = (id: ComputedRef<string>, options?: Options) => {
    const artistStore = useArtistStore()
    const { getById: getArtistById } = storeToRefs(artistStore)

    const releaseStore = useReleaseStore()

    const mediaListStore = useMediaListStore()

    const artist = computed(() => {
        return getArtistById.value(id.value)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.artists.getById(id.value)
    }, {
        onSuccess: (res) => {
            const artist = res.data.data.artist

            artistStore.addItem(artist)

            const releases = res.data.data.releases

            releaseStore.addItems(releases.items)

            mediaListStore.createMediaList({
                id: `artist:${artist.id}:releases`,
                items: releases.items.map(release => release.id),
                count: releases.count,
            })
        },
        onError: (err) => {
            if (options && typeof options.onError === "function") {
                options.onError(err)
            }
        },
    })

    watch(id, async () => {
        if (artist.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (artist.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    return {
        data: artist,
        fetch,
        isLoading,
    }
}
