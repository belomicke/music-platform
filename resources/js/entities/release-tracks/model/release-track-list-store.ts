import { computed, ref } from "vue"
import { defineStore } from "pinia"

interface ReleaseTrackList {
    id: string
    tracks: string[]
    count: number
}

export const useReleaseTrackListStore = defineStore("release-tracks", () => {
    const lists = ref<ReleaseTrackList[]>([])

    const getReleaseTracks = computed(() => {
        return (id: string) => {
            const list = lists.value.find(item => item.id === id)

            if (list === undefined) {
                return {
                    id,
                    tracks: [],
                    count: 0,
                }
            }

            return list
        }
    })

    const addReleaseTracks = (value: ReleaseTrackList) => {
        const list = lists.value.find(item => item.id === value.id)

        if (list === undefined) {
            lists.value.push(value)
            return
        }

        list.tracks.push(...value.tracks)
        list.count = value.count
    }

    return {
        getReleaseTracks,
        addReleaseTracks,
    }
})
