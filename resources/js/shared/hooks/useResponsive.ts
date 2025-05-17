import { computed, onMounted, onUnmounted, ref } from "vue"

type DeviceType = "desktop" | "tablet" | "mobile"

export const useResponsive = () => {
    const width = ref<number>(window.innerWidth)
    const height = ref<number>(window.innerHeight)

    const windowSize = computed(() => ({
        width,
        height,
    }))

    const deviceType = computed<DeviceType>(() => {
        if (width.value > 1024) {
            return "desktop"
        } else if (width.value >= 768) {
            return "tablet"
        } else {
            return "mobile"
        }
    })

    onMounted(() => {
        window.addEventListener("resize", getWindowSize)
    })

    onUnmounted(() => {
        window.removeEventListener("resize", getWindowSize)
    })

    const getWindowSize = () => {
        width.value = window.innerWidth
        height.value = window.innerHeight
    }

    return {
        windowSize,
        deviceType,
    }
}
