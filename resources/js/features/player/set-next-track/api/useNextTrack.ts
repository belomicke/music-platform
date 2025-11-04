import { useBackendPlayerStore } from "@/entities/backend-player"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"
import { PlayerStateResponse } from "@/shared/api/methods/player"

export const useNextTrack = () => {
    const backendPlayerStore = useBackendPlayerStore()

    const { fetch: setNextTrack, isLoading } = useFetch<PlayerStateResponse>(async () => {
        return await api.player.setNextTrack()
    }, {
        onSuccess: async (res) => {
            if (res.data.success) {
                backendPlayerStore.setState(res.data.data)
                await backendPlayerStore.play()
            }
        },
    })

    return {
        mutate: setNextTrack,
        isLoading,
    }
}
