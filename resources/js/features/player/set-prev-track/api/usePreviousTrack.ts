import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { PlayerStateResponse } from "@/shared/api/methods/player"

export const usePreviousTrack = () => {
    const backendPlayerStore = useBackendPlayerStore()
    const { getCurrentTime } = storeToRefs(backendPlayerStore)

    const { fetch: setPreviousTrack, isLoading } = useFetch<PlayerStateResponse>(async () => {
        return await api.player.setPreviousTrack()
    }, {
        onSuccess: async (res) => {
            if (res.data.success) {
                backendPlayerStore.setState(res.data.data)
                await backendPlayerStore.play()
            }
        },
    })

    const mutate = async () => {
        if (getCurrentTime.value > 5) {
            backendPlayerStore.setPlayerTime(0)
            return
        }

        await setPreviousTrack()
    }

    return {
        mutate,
        isLoading,
    }
}
