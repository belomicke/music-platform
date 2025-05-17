import { computed, ComputedRef, onMounted, watch } from "vue"
import { storeToRefs } from "pinia"
import { useCompactArtistStore } from "@/entities/artist"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useReleaseById = (id: ComputedRef<string>) => {
    const releaseStore = useReleaseStore()
    const compactArtistStore = useCompactArtistStore()
    const { getById: getReleaseById } = storeToRefs(releaseStore)

    const release = computed(() => {
        return getReleaseById.value(id.value)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.releases.getById(id.value)
    }, {
        onSuccess: (res) => {
            const release = res.data.data.release
            const artists = release.artists

            compactArtistStore.addItems(artists)

            releaseStore.addItem(release)
        },
    })

    watch(id, async () => {
        if (release.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    onMounted(async () => {
        if (release.value === undefined && isLoading.value === false) {
            await fetch()
        }
    })

    return {
        data: release,
        fetch,
        isLoading,
    }
}
