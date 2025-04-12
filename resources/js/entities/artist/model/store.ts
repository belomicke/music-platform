import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { IArtist } from "@/shared/api"

export const useArtistStore = defineStore("artists", () => {
    const artists = ref<IArtist[]>([])

    const getArtistById = computed(() => {
        return (id: string): IArtist | undefined => {
            return artists.value.find(artist => artist.id === id)
        }
    })

    const addArtist = (artist: IArtist) => {
        if (getArtistById.value(artist.id) === undefined) {
            artists.value.push(artist)
        }
    }

    return {
        getArtistById,
        addArtist,
    }
})
