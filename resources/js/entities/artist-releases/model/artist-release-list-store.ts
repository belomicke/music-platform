import { computed, ref } from "vue"
import { defineStore } from "pinia"

interface ArtistReleasesList {
    id: string
    releases: string[]
    count: number
}

export const useArtistReleaseListStore = defineStore("artist-releases", () => {
    const lists = ref<ArtistReleasesList[]>([])

    const getArtistReleases = computed(() => {
        return (id: string) => {
            return lists.value.find(release => release.id === id)
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
