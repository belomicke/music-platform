<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useUserById } from "@/features/users/user-by-id"
import { ProfilePageHeader } from "@/entities/user"

const route = useRoute()

const id = computed<string>(() => {
    return route.params.id as string
})

const { user } = useUserById(id)
</script>

<template>
    <profile-page-header
        :user="user"
        v-if="user"
    />
</template>

<style lang="scss">

</style>
