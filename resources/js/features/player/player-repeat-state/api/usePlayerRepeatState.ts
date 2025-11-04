import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { RepeatState } from "@/shared/api/types"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const usePlayerRepeatState = () => {
    const backendPlayerStore = useBackendPlayerStore()
    const { getRepeatState: repeatState } = storeToRefs(backendPlayerStore)

    const { fetch } = useFetch(async (value: RepeatState) => {
        return await api.player.setRepeatState(value)
    })

    const mutate = async () => {
        debouncedFetch.cancel()

        const value = toggleRepeatState()

        await debouncedFetch(value)
    }

    const debouncedFetch = debounce(async (value: RepeatState) => {
        await fetch(value)
    }, 500)

    const toggleRepeatState = () => {
        if (repeatState.value === "off") {
            backendPlayerStore.setRepeatState("context")
            return "context"
        } else if (repeatState.value === "context") {
            backendPlayerStore.setRepeatState("track")
            return "track"
        } else {
            backendPlayerStore.setRepeatState("off")
            return "off"
        }
    }

    return {
        data: repeatState,
        mutate,
    }
}
