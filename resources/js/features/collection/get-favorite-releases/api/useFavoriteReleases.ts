import { computed, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCurrentUser } from "@/features/auth/current-user"
import { useCollectionStore } from "@/entities/collection"
import { useReleaseStore } from "@/entities/release"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useFavoriteReleases = () => {
    const releaseStore = useReleaseStore()
    const { getSeveralReleases } = storeToRefs(releaseStore)

    const collectionStore = useCollectionStore()
    const { getFavoriteReleases, getReleasesCount } = storeToRefs(collectionStore)

    const { data: user } = useCurrentUser()

    const releases = computed(() => {
        return getSeveralReleases.value(getFavoriteReleases.value)
    })

    const count = computed(() => {
        return getReleasesCount.value
    })

    const hasMore = computed((): boolean => {
        return releases.value.length < count.value
    })

    const after = computed(() => {
        if (releases.value.length === 0) return ""

        return releases.value.at(-1).id
    })

    const { fetch, isLoading } = useFetch(async (after: string) => {
        return await api.collection.getFavoriteReleases(after)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            releaseStore.addItems(data.releases)

            collectionStore.addReleases(data.releases.map(release => release.id))
            collectionStore.setReleasesCount(data.count)
        },
    })

    onMounted(async () => {
        if (user.value.favorite_releases_count !== getReleasesCount.value) {
            await fetch(after.value)
        }
    })

    const getMore = async () => {
        if (isLoading.value) return
        if (hasMore.value === false) return

        await fetch(after.value)
    }

    return {
        data: releases,
        isLoading,
        hasMore,
        getMore,
    }
}
