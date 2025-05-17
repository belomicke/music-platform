import { computed, ref } from "vue"
import { defineStore } from "pinia"
import { ApiRelease } from "@/shared/api"

export const useReleaseStore = defineStore("release", () => {
    const releases = ref<ApiRelease[]>([])

    const getById = computed(() => {
        return (id: string) => {
            return releases.value.find(release => release.id === id)
        }
    })

    const getManyById = computed(() => {
        return (ids: string[]): ApiRelease[] | undefined => {
            const result: ApiRelease[] = []

            ids.forEach(id => {
                result.push(releases.value.find(release => release.id === id))
            })

            return result
        }
    })

    const addItem = (data: ApiRelease) => {
        if (releases.value.find(release => release.id === data.id) === undefined) {
            releases.value.push(data)
        }
    }

    const addItems = (data: ApiRelease[]) => {
        data.forEach(item => addItem(item))
    }

    const follow = (id: string) => {
        const release = releases.value.find(release => release.id === id)

        if (!release) return

        release.is_followed = true
    }

    const unfollow = (id: string) => {
        const release = releases.value.find(release => release.id === id)

        if (!release) return

        release.is_followed = false
    }

    return {
        getById,
        getManyById,

        addItem,
        addItems,

        follow,
        unfollow,
    }
})
