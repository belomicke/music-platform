import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { type ApiArtist } from "@/shared/api"

export const useArtistStore = defineStore("artists", () => {
    const artists = ref<ApiArtist[]>([])

    const getById = computed(() => {
        return (id: string): ApiArtist | undefined => {
            return artists.value.find(artist => artist.id === id)
        }
    })

    const getManyById = computed(() => {
        return (ids: string[]): ApiArtist[] | undefined => {
            const result: ApiArtist[] = []

            ids.forEach(id => {
                result.push(artists.value.find(artist => artist.id === id))
            })

            return result
        }
    })

    const addItem = (artist: ApiArtist) => {
        if (getById.value(artist.id) === undefined) {
            artists.value.push(artist)
        }
    }

    const addItems = (value: ApiArtist[]) => {
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
