import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiCompactArtist } from "@/shared/api"

export const useCompactArtistStore = defineStore("compact-artists", () => {
    const artists = ref<ApiCompactArtist[]>([])

    const getCompactArtistById = computed(() => {
        return (id: string): ApiCompactArtist | undefined => {
            return artists.value.find(artist => artist.id === id)
        }
    })

    const getCompactArtistsByIds = computed(() => {
        return (ids: string[]): ApiCompactArtist[] | undefined => {
            const result: ApiCompactArtist[] = []

            ids.forEach(id => {
                result.push(artists.value.find(artist => artist.id === id))
            })

            return result
        }
    })

    const addCompactArtist = (artist: ApiCompactArtist) => {
        if (getCompactArtistById.value(artist.id) === undefined) {
            artists.value.push(artist)
        }
    }

    const addCompactArtists = (value: ApiCompactArtist[]) => {
        value.forEach(item => addCompactArtist(item))
    }

    return {
        getCompactArtistById,
        getCompactArtistsByIds,

        addCompactArtist,
        addCompactArtists,
    }
})
