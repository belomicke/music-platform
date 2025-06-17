import { computed, ref } from "vue"
import { defineStore } from "pinia"

interface Queue {
    id: string
    items: string[]
    count: number
}

export const useQueueStore = defineStore("queue", () => {
    const queues = ref<Queue[]>([])
    const currentQueueId = ref<string>(localStorage.getItem("current-queue-id") ?? "")
    const currentTrackIndex = ref<number>(Number(localStorage.getItem("current-track-index")) ?? 0)

    const getCurrentQueueId = computed(() => currentQueueId.value)
    const getCurrentQueue = computed(() => {
        return queues.value.find(item => item.id === currentQueueId.value)
    })
    const getCurrentTrackIndex = computed(() => currentTrackIndex.value)

    const createQueue = (value: Queue) => {
        if (queues.value.find(queue => queue.id === value.id) === undefined) {
            queues.value.push(value)
        }
    }

    const setQueueId = (value: string) => {
        currentQueueId.value = value
        localStorage.setItem("current-queue-id", value)
    }

    const setCurrentTrackIndex = (value: number) => {
        currentTrackIndex.value = value
        localStorage.setItem("current-track-index", JSON.stringify(value))
    }

    return {
        getCurrentQueueId,
        getCurrentQueue,
        getCurrentTrackIndex,

        createQueue,

        setQueueId,

        setCurrentTrackIndex
    }
})
