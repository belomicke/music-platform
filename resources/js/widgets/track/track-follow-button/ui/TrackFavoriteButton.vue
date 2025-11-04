<script setup lang="ts">
import { computed, ref } from "vue"
import { storeToRefs } from "pinia"
import debounce from "lodash.debounce"
import { useRemoveTrackFromCollection } from "@/features/collection/remove-track-from-collection"
import { useAddTrackToCollection } from "@/features/collection/add-track-to-collection"
import { useCurrentUser } from "@/features/auth/current-user"
import { useTrackStore } from "@/entities/track"
import { IIconButton } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    size?: number
    iconSize?: number
}>(), {
    size: 40,
    iconSize: 20,
})

const { isAuth } = useCurrentUser()

const id = computed(() => props.id)

const trackStore = useTrackStore()
const { getTrackById } = storeToRefs(trackStore)

const track = computed(() => getTrackById.value(id.value))

const isFavorite = ref<boolean>(track.value.is_favorite)

const { mutate: add } = useAddTrackToCollection(id, {
    onSuccess: (res) => {
        if (res.data.success) {
            isFavorite.value = true
        }
    },
})

const { mutate: remove } = useRemoveTrackFromCollection(id, {
    onSuccess: (res) => {
        if (res.data.success) {
            isFavorite.value = false
        }
    },
})

const addToCollection = debounce(() => add(), 500)
const removeFromCollection = debounce(() => remove(), 500)

const mutate = () => {
    if (track.value.is_favorite) {
        addToCollection.cancel()
        trackStore.setIsFavorite(id.value, false)

        if (isFavorite.value === !track.value.is_favorite) {
            removeFromCollection()
        }
    } else {
        removeFromCollection.cancel()
        trackStore.setIsFavorite(id.value, true)

        if (isFavorite.value === !track.value.is_favorite) {
            addToCollection()
        }
    }
}
</script>

<template>
    <i-icon-button
        icon="heart"
        size="xxs"
        :icon-size="iconSize"
        :filled="track.is_favorite"
        @click="mutate"
        variant="transparent"
        :disabled="isAuth === false"
    />
</template>
