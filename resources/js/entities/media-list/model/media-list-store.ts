import { computed, ref } from "vue"
import { defineStore } from "pinia"

interface MediaList {
    id: string
    items: string[]
    count: number
}

export const useMediaListStore = defineStore("media-list", () => {
    const mediaLists = ref<MediaList[]>([])

    const getPopularArtistsMediaListId = computed(() => {
        return `popular-artists`
    })

    const getFavoriteArtistsMediaListId = computed(() => {
        return `favorite-artists`
    })

    const getMediaListById = computed(() => {
        return (id: string): MediaList | undefined => {
            return mediaLists.value.find(item => item.id === id)
        }
    })

    const addItemsToMediaList = (value: MediaList) => {
        const mediaList = mediaLists.value.find(item => item.id === value.id)

        if (!mediaList) {
            mediaLists.value.push(value)
            return
        }

        mediaList.items.push(...value.items)
        mediaList.count = value.count
    }

    const attachItem = (id: string, value: string) => {
        const mediaList = mediaLists.value.find(item => item.id === id)

        if (!mediaList) return

        mediaList.items.unshift(value)
        mediaList.count++
    }

    const detachItem = (id: string, value: string) => {
        const mediaList = mediaLists.value.find(item => item.id === id)

        if (!mediaList) return

        mediaList.items = mediaList.items.filter(item => item !== value)
        mediaList.count--
    }

    return {
        getPopularArtistsMediaListId,
        getFavoriteArtistsMediaListId,

        getMediaListById,

        addItemsToMediaList,

        attachItem,
        detachItem,
    }
})
