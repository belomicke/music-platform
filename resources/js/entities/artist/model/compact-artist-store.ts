import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiCompactArtist } from "@/shared/api"

export const useCompactArtistStore = defineStore("compact-artists", () => {
    const artists = ref<ApiCompactArtist[]>([])

    const getById = computed(() => {
        return (id: string): ApiCompactArtist | undefined => {
            return artists.value.find(artist => artist.id === id)
        }
    })

    const getManyById = computed(() => {
        return (ids: string[]): ApiCompactArtist[] | undefined => {
            const result: ApiCompactArtist[] = []

            ids.forEach(id => {
                result.push(artists.value.find(artist => artist.id === id))
            })

            return result
        }
    })

    const addItem = (artist: ApiCompactArtist) => {
        if (getById.value(artist.id) === undefined) {
            artists.value.push(artist)
        }
    }

    const addItems = (value: ApiCompactArtist[]) => {
        value.forEach(item => addItem(item))
    }

    const follow = (id: string) => {
        const artist = artists.value.find(artist => artist.id === id)

        if (!artist) return

        if (artist.is_followed === false) {
            artist.is_followed = true
        }
    }

    const unfollow = (id: string) => {
        const artist = artists.value.find(artist => artist.id === id)

        if (!artist) return

        if (artist.is_followed === true) {
            artist.is_followed = false
        }
    }

    return {
        getById,
        getManyById,

        addItem,
        addItems,

        follow,
        unfollow,
    }
})
