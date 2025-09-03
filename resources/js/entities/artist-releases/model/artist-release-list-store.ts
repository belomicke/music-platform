import { computed, ref } from "vue"
import { defineStore } from "pinia"

interface ArtistReleasesList {
    id: string
    releases: string[]
    count: number
}

export const useArtistReleasesStore = defineStore("artist-releases", () => {
    const lists = ref<ArtistReleasesList[]>([])

    const getArtistReleases = computed(() => {
        return (id: string) => {
            const list = lists.value.find(release => release.id === id)

            if (list === undefined) {
                return {
                    id,
                    releases: [],
                    count: 0,
                }
            }

            return list
        }
    })

    const addArtistReleases = (value: ArtistReleasesList) => {
        const list = lists.value.find(item => item.id === value.id)

        if (list === undefined) {
            lists.value.push(value)
            return
        }

        list.releases.push(...value.releases)
        list.count = value.count
    }

    return {
        getArtistReleases,
        addArtistReleases,
    }
})
