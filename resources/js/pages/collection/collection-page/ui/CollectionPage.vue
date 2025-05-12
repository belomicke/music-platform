<script setup lang="ts">
import { FavoriteArtistsCarousel } from "@/features/collection/favorite-artists"
import { useCurrentUser } from "@/features/auth/current-user"

const { data: user } = useCurrentUser()
</script>

<template>
    <div
        class="collection-page"
        v-if="user"
    >
        <favorite-artists-carousel
            :id="user.id"
        />
    </div>
</template>

<style lang="scss">
.collection-page {
    padding-bottom: 24px;
}
</style>
