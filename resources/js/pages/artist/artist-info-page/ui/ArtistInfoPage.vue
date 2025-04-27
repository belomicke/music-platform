<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useArtistById } from "@/features/artists/get-artist-by-id"
import { ArtistFollowButton } from "@/features/artists/following"
import { useCurrentUser } from "@/features/auth/current-user"
import { ArtistPageHeader } from "@/entities/artist"
import { MediaPageBody } from "@/shared/ui"

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: currentUser } = useCurrentUser()
const { data: artist } = useArtistById(id)
</script>

<template>
    <template v-if="artist">
        <artist-page-header
            :artist="artist"
            v-if="artist"
        />
        <media-page-body>
            <div class="artist-info-page-actions">
                <artist-follow-button
                    :artist="artist"
                    v-if="artist && currentUser"
                />
            </div>
        </media-page-body>
    </template>
</template>

<style lang="scss">

</style>
