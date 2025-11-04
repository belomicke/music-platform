<script setup lang="ts">
import { computed, ref } from "vue"
import debounce from "lodash.debounce"
import { useRemoveReleaseFromCollection } from "@/features/collection/remove-release-from-collection"
import { useAddReleaseToCollection } from "@/features/collection/add-release-to-collection"
import { useReleaseById } from "@/features/releases/get-release-by-id"
import { useCurrentUser } from "@/features/auth/current-user"
import { IButton, IButtonVariants, type UiSize } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    variant?: IButtonVariants
    iconSize?: UiSize,
    withCount?: boolean
}>(), {
    variant: "ghost",
    withCount: false,
})

const id = computed(() => props.id)

const { data: release } = useReleaseById(id)

const { isAuth } = useCurrentUser()

const { mutate: addRelease } = useAddReleaseToCollection(id)
const { mutate: removeRelease } = useRemoveReleaseFromCollection(id)

const isFollow = ref<boolean>(release.value.is_followed)

const mutate = () => {
    debounced.cancel()

    isFollow.value = !isFollow.value

    debounced()
}

const debounced = debounce(async () => {
    if (isFollow.value) {
        await addRelease()
    } else {
        await removeRelease()
    }
}, 500)
</script>

<template>
    <i-button
        @click="mutate"
        :variant="variant"
        round
        icon="heart"
        :icon-button="withCount === false"
        :icon-filled="isFollow"
        :disabled="isAuth === false"
    >
        <template v-if="withCount">
            {{ release.like_count }}
        </template>
    </i-button>
</template>
