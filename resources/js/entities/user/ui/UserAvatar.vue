<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { useUserStore } from "@/entities/user"

const props = withDefaults(defineProps<{
    id: string
    size?: number
}>(), {
    size: 36,
})

const userStore = useUserStore()
const { getUserById } = storeToRefs(userStore)

const user = computed(() => {
    return getUserById.value(props.id)
})
</script>

<template>
    <div
        class="user-avatar"
        :style="{
            'width': `${size}px`,
            'height': `${size}px`,
        }"
    >
        {{ user.name[0].toUpperCase() }}
    </div>
</template>

<style lang="scss">
.user-avatar {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #67c23a;
    border-radius: 50%;
    user-select: none;
    cursor: pointer;

    font-size: 16px;
    font-weight: 800;
}
</style>
