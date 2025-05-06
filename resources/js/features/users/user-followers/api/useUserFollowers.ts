import { computed, ComputedRef, onMounted } from "vue"
import { storeToRefs } from "pinia"
import { useCompactUserStore } from "@/entities/user"
import { useMediaList, useMediaListStore } from "@/entities/media-list"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const useUserFollowers = (id: ComputedRef<string>) => {
    const compactUserStore = useCompactUserStore()
    const { getManyById: getManyCompactUsersById } = storeToRefs(compactUserStore)

    const mediaListStore = useMediaListStore()
    const { getUserFollowersMediaListId } = storeToRefs(mediaListStore)

    const mediaListId = computed(() => {
        return getUserFollowersMediaListId.value(id.value)
    })

    const { data, hasMore } = useMediaList(mediaListId)

    const users = computed(() => {
        if (data.value === undefined) return []

        return getManyCompactUsersById.value(data.value.items)
    })

    const { fetch, isLoading } = useFetch(async () => {
        return await api.users.getFollowers(id.value, users.value.length)
    }, {
        onSuccess: (res) => {
            const data = res.data.data

            compactUserStore.addItems(data.users)

            mediaListStore.addItemsToMediaList({
                id: mediaListId.value,
                items: data.users.map(item => item.id),
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
        data: users,
        isLoading,
        hasMore,
        getMore,
    }
}
