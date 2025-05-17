import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteReleases = () => {
    const releaseStore = useReleaseStore()
    const { getManyById: getManyReleasesById } = storeToRefs(releaseStore)

    const mediaListStore = useMediaListStore()
    const { getFavoriteReleasesMediaListId, getMediaListById } = storeToRefs(mediaListStore)

    const mediaListId = computed(() => {
        return getFavoriteReleasesMediaListId.value
    })

    const data = computed(() => {
        return getMediaListById.value(mediaListId.value)
    })

    const releases = computed(() => {
        if (data.value === undefined) return []

        return getManyReleasesById.value(data.value.items)
    })

    const hasMore = computed((): boolean | undefined => {
        if (data.value === undefined) return undefined

        return data.value.items.length < data.value.count
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.collection.getFavoriteReleases(releases.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            releaseStore.addItems(data.releases)

            mediaListStore.addItemsToMediaList({
                id: mediaListId.value,
                items: data.releases.map(item => item.id),
                count: data.count,
            })
        },
    })

    onMounted(async () => {
        if (data.value === undefined) {
            await fetch()
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch()
    }

    return {
        mediaListId,
        data: releases,
        isLoading,
        hasMore,
        getMore,
    }
}
