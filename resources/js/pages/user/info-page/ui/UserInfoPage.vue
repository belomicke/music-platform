<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { UserFollowedUsersList } from "@/features/users/user-followed-users"
import { UserFollowedArtistsList } from "@/features/users/user-followed-artists"
import { useUserById } from "@/features/users/user-by-id"
import { UserFollowButton } from "@/features/users/following"
import { useCurrentUser } from "@/features/auth/current-user"
import { UserPageHeader } from "@/entities/user"
import { MediaPageActionsContainer, MediaPageBody } from "@/shared/ui"

const route = useRoute()

const id = computed<string>(() => {
    return route.params.id as string
})

const { data: user } = useUserById(id)
const { data: currentUser } = useCurrentUser()
</script>

<template>
    <template v-if="user">
        <user-page-header
            :user="user"
            v-if="user"
        />
        <media-page-body>
            <media-page-actions-container>
                <user-follow-button
                    :user="user"
                    v-if="user && currentUser && user.id !== currentUser.id"
                />
            </media-page-actions-container>
            <div class="user-info-page__lists">
                <user-followed-artists-list
                    :id="user.id"
                    with-title
                    one-row
                    v-if="user && user.followed_artists_count > 0"
                />
                <user-followed-users-list
                    :id="user.id"
                    with-title
                    one-row
                    v-if="user && user.followed_users_count > 0"
                />
            </div>
        </media-page-body>
    </template>
</template>

<style lang="scss">
.user-info-page {
    &__lists {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
}
</style>
