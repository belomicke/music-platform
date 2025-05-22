<script setup lang="ts">
import { useCurrentUser } from "@/features/auth/current-user"
import { PlaylistPageHeader } from "@/entities/playlist"

const { data: user } = useCurrentUser()
</script>

<template>
    <playlist-page-header
        title="Мне нравится"
        :creator="user.name"
    />
</template>

<style scoped lang="scss">

</style>
