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

    const mediaListExists = (id: string) => {
        const mediaList = mediaLists.value.find(item => item.id === id)

        return mediaList !== undefined
    }

    const createMediaList = (value: MediaList) => {
        const mediaList = mediaLists.value.find(item => item.id === value.id)

        if (mediaList) {
            return
        }

        mediaLists.value.push(value)
    }

    const addItemsToMediaList = (value: MediaList) => {
        const mediaList = mediaLists.value.find(item => item.id === value.id)

        if (!mediaList) {
            mediaLists.value.push(value)
            return
        }

        value.items.forEach(item => {
            if (mediaList.items.find(i => i === item) === undefined) {
                mediaList.items.push(item)
            }
        })

        mediaList.count = value.count
    }

    const attachItem = (id: string, value: string) => {
        const mediaList = mediaLists.value.find(item => item.id === id)

        if (mediaList && mediaList.items.find(item => item === value) === undefined) {
            mediaList.items.unshift(value)
            mediaList.count++
        }
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

        createMediaList,
        mediaListExists,

        addItemsToMediaList,

        attachItem,
        detachItem,
    }
})
