import { computed, ComputedRef, ref } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useAddTrackToFavorite, useRemoveTrackFromFavorite } from "../api"
import { useMediaListStore } from "@/entities/media-list"
import { useTrackStore } from "@/entities/track"
import { useAuthStore } from "@/entities/auth"

export const useTrackFollowing = (id: ComputedRef<string>) => {
    const mediaListStore = useMediaListStore()
    const { getFavoriteTracksMediaListId } = storeToRefs(mediaListStore)

    const authStore = useAuthStore()

    const trackStore = useTrackStore()
    const { getById: getTrackById } = storeToRefs(trackStore)

    const { fetch: addToFavorite } = useAddTrackToFavorite(id)
    const { fetch: removeFromFavorite } = useRemoveTrackFromFavorite(id)

    const mediaListId = computed(() => {
        return getFavoriteTracksMediaListId.value
    })

    const track = computed(() => {
        return getTrackById.value(id.value)
    })

    const isFavorite = ref<boolean | undefined>(track.value.is_favorite)

    const mutate = async () => {
        const status = track.value.is_favorite

        if (status) {
            trackStore.removeFromFavorite(id.value)
        } else {
            trackStore.addToFavorite(id.value)
            const addedToMediaList = mediaListStore.attachItem(mediaListId.value, id.value)

            if (addedToMediaList) {
                authStore.incrementFavoriteTracksCount()
            }
        }

        if (isFavorite.value === !status) {
            debounceHandler.cancel()
        } else {
            await debounceHandler(status)
        }
    }

    const debounceHandler = debounce(async (value: boolean) => {
        if (value) {
            await removeFromFavorite()
        } else {
            await addToFavorite()
        }

        isFavorite.value = !value
    }, 500)

    return {
        isFavorite: computed(() => track.value.is_favorite),
        mutate,
    }
}
