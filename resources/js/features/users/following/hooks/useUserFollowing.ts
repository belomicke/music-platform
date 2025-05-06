import { computed, ComputedRef, ref } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useFollowUser, useUnfollowUser } from "../api"
import { useCurrentUser } from "@/features/auth/current-user"
import { useMediaListStore } from "@/entities/media-list"
import { useCompactUserStore, useUserStore } from "@/entities/user"

export const useUserFollowing = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getUserFollowedUsersMediaListId } = storeToRefs(mediaListStore)

    const userStore = useUserStore()
    const { getById: getUserById } = storeToRefs(userStore)

    const compactUserStore = useCompactUserStore()

    const { fetch: follow } = useFollowUser(id)
    const { fetch: unfollow } = useUnfollowUser(id)

    const { data: currentUser } = useCurrentUser()

    const mediaListId = computed(() => {
        return getUserFollowedUsersMediaListId.value(currentUser.value.id)
    })

    const user = computed(() => {
        return getUserById.value(id.value)
    })

    const isFollow = ref<boolean | undefined>(user.value.is_followed)

    const mutate = async () => {
        const status = user.value.is_followed

        if (status) {
            userStore.unfollow(id.value)
            compactUserStore.unfollow(id.value)
            mediaListStore.detachItem(mediaListId.value, id.value)
        } else {
            userStore.follow(id.value)
            compactUserStore.follow(id.value)
            mediaListStore.attachItem(mediaListId.value, id.value)
        }

        if (isFollow.value === !status) {
            debounceHandler.cancel()
        } else {
            await debounceHandler(status)
        }
    }

    const debounceHandler = debounce(async (value: boolean) => {
        if (value) {
            await unfollow()
        } else {
            await follow()
        }

        isFollow.value = !value
    }, 500)

    return {
        isFollow: computed(() => user.value.is_followed),
        mutate,
    }
}
