import { computed, ComputedRef, ref } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useFollowArtist, useUnfollowArtist } from "../api"
import { useCurrentUser } from "@/features/auth/current-user"
import { useMediaListStore } from "@/entities/media-list"
import { useArtistStore } from "@/entities/artist"

export const useArtistFollowing = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getUserFollowedArtistsMediaListId } = storeToRefs(mediaListStore)

    const artistStore = useArtistStore()
    const { getArtistById } = storeToRefs(artistStore)

    const { fetch: follow } = useFollowArtist(id)
    const { fetch: unfollow } = useUnfollowArtist(id)

    const { data: user } = useCurrentUser()

    const mediaListId = computed(() => {
        return getUserFollowedArtistsMediaListId.value(user.value.id)
    })

    const artist = computed(() => {
        return getArtistById.value(id.value)
    })

    const isFollow = ref<boolean | undefined>(artist.value.followers.status)

    const mutate = async () => {
        const status = artist.value.followers.status

        if (status) {
            artistStore.unfollowArtist(id.value)
            mediaListStore.detachItem(mediaListId.value, id.value)
        } else {
            artistStore.followArtist(id.value)
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
        isFollow: artist.value.followers.status,
        mutate,
    }
}
