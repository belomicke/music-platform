import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiTrack } from "@/shared/api"

export const useTrackStore = defineStore("track-store", () => {
    const tracks = ref<ApiTrack[]>([])

    const getTrackById = computed(() => {
        return (id: string): ApiTrack | undefined => {
            return tracks.value.find(track => track.id === id)
        }
    })

    const getSeveralTracks = computed(() => {
        return (ids: string[]): ApiTrack[] => {
            const result: ApiTrack[] = []

            ids.forEach(id => {
                result.push(
                    tracks.value.find(track => track.id === id),
                )
            })

            return result
        }
    })

    const addItem = (value: ApiTrack) => {
        if (!tracks.value.find(track => track.id === value.id)) {
            tracks.value.push(value)
        }
    }

    const addItems = (values: ApiTrack[]) => {
        values.forEach(value => addItem(value))
    }

    const setIsFavorite = (id: string, value: boolean) => {
        const track = tracks.value.find(track => track.id === id)

        if (!track) return

        track.is_favorite = value
    }

    return {
        getTrackById,
        getSeveralTracks,

        addItem,
        addItems,

        setIsFavorite,
    }
})
