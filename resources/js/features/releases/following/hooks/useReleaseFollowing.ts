import { computed, ComputedRef, ref } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useFollowRelease, useUnfollowRelease } from "../api"
import { useMediaListStore } from "@/entities/media-list"
import { useReleaseStore } from "@/entities/release"

export const useReleaseFollowing = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getFavoriteReleasesMediaListId } = storeToRefs(mediaListStore)

    const releaseStore = useReleaseStore()
    const { getById: getReleaseById } = storeToRefs(releaseStore)

    const { fetch: follow } = useFollowRelease(id)
    const { fetch: unfollow } = useUnfollowRelease(id)

    const mediaListId = computed(() => {
        return getFavoriteReleasesMediaListId.value
    })

    const release = computed(() => {
        return getReleaseById.value(id.value)
    })

    const isFollow = ref<boolean | undefined>(release.value.is_followed)

    const mutate = async () => {
        const status = release.value.is_followed

        if (status) {
            releaseStore.unfollow(id.value)
        } else {
            releaseStore.follow(id.value)
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
        isFollow: computed(() => release.value.is_followed),
        mutate,
    }
}
