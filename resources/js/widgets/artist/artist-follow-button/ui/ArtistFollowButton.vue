<script setup lang="ts">
import { computed, ref } from "vue"
import debounce from "lodash.debounce"
import { useRemoveArtistFromCollection } from "@/features/collection/remove-artist-from-collection"
import { useAddArtistToCollection } from "@/features/collection/add-artist-to-collection"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { useCurrentUser } from "@/features/auth/current-user"
import { IButton, type IButtonVariants, type UiSize } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string,
    variant?: IButtonVariants,
    iconSize?: UiSize,
}>(), {
    variant: "ghost",
})

const id = computed(() => props.id)

const { isAuth } = useCurrentUser()

const { data: artist } = useArtistById(id)

const { mutate: addToCollection } = useAddArtistToCollection(id)
const { mutate: removeFromCollection } = useRemoveArtistFromCollection(id)

const isFollow = ref<boolean>(artist.value.is_followed)

const mutate = () => {
    debounced.cancel()

    isFollow.value = !isFollow.value

    debounced()
}

const debounced = debounce(async () => {
    if (isFollow.value) {
        await addToCollection()
    } else {
        await removeFromCollection()
    }
}, 500)
</script>

<template>

    <i-button
        @click="mutate"
        icon-button
        :variant="variant"
        round
        icon="heart"
        :icon-filled="isFollow"
        :icon-size="iconSize"
        :disabled="isAuth === false"
    />
</template>

<style lang="scss">

</style>
