import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { type ApiArtist } from "@/shared/api"

export const useArtistStore = defineStore("artists", () => {
    const artists = ref<ApiArtist[]>([])

    const getArtistById = computed(() => {
        return (id: string): ApiArtist | undefined => {
            return artists.value.find(artist => artist.id === id)
        }
    })

    const getArtistsByIds = computed(() => {
        return (ids: string[]): ApiArtist[] | undefined => {
            const result: ApiArtist[] = []

            ids.forEach(id => {
                result.push(artists.value.find(artist => artist.id === id))
            })

            return result
        }
    })

    const addArtist = (artist: ApiArtist) => {
        if (getArtistById.value(artist.id) === undefined) {
            artists.value.push(artist)
        }
    }

    const addArtists = (value: ApiArtist[]) => {
        value.forEach(item => addArtist(item))
    }

    const followArtist = (id: string) => {
        const artist = artists.value.find(artist => artist.id === id)

        if (!artist) return

        if (artist.followers.status === false) {
            artist.followers.status = true
            artist.followers.total++
        }
    }

    const unfollowArtist = (id: string) => {
        const artist = artists.value.find(artist => artist.id === id)

        if (!artist) return

        if (artist.followers.status === true) {
            artist.followers.status = false
            artist.followers.total--
        }
    }

    return {
        getArtistById,
        getArtistsByIds,

        addArtist,
        addArtists,

        followArtist,
        unfollowArtist,
    }
})
