import { computed, ref, watch } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { useFetch } from "@/shared/hooks"
import { api } from "@/shared/api"

export const usePlayerVolume = () => {
    const backendPlayerStore = useBackendPlayerStore()
    const { getVolume: volume } = storeToRefs(backendPlayerStore)

    const volumeBeforeMute = ref<number>(volume.value)

    const isMuted = computed(() => volume.value === 0)

    const { fetch } = useFetch(async (value: number) => {
        return await api.player.setVolume(value)
    })

    watch(volume, () => {
        if (volume.value !== 0) {
            volumeBeforeMute.value = volume.value
        }
    })

    const setVolume = async (value: number) => {
        debouncedFetch.cancel()

        backendPlayerStore.setVolume(value)

        await debouncedFetch(value)
    }

    const debouncedFetch = debounce(async (value: number) => {
        await fetch(value)
    }, 500)

    const mute = async () => {
        if (isMuted.value === false) {
            volumeBeforeMute.value = volume.value
            await setVolume(0)
        } else {
            await setVolume(volumeBeforeMute.value)
        }
    }

    return {
        data: volume,
        setVolume,
        mute,
    }
}
