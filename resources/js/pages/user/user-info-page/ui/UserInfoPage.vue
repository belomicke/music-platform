<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { UserFollowedArtistList } from "@/features/artists/user-followed-artists"
import { useUserById } from "@/features/users/user-by-id"
import { UserPageHeader } from "@/entities/user"
import { MediaPageBody } from "@/shared/ui"

const route = useRoute()

const id = computed<string>(() => {
    return route.params.id as string
})

const { user } = useUserById(id)
</script>

<template>
    <user-page-header
        :user="user"
        v-if="user"
    />
    <media-page-body>
        <user-followed-artist-list
            :id="user.id"
            with-title
            one-row
            v-if="user"
        />
    </media-page-body>
</template>
