<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import { UserFollowedArtistsList } from "@/features/users/user-followed-artists"
import { useUserById } from "@/features/users/user-by-id"
import { MediaFollowingPage } from "@/shared/ui"

const { t } = useI18n()

const route = useRoute()

const id = computed(() => {
    return route.params.id as string
})

const { data: user } = useUserById(id)
</script>

<template>
    <media-following-page
        :title="t('page.user.followed-artists.header.title', { name: user.name })"
        v-if="user"
    >
        <user-followed-artists-list
            :id="id"
            v-if="id"
        />
    </media-following-page>
</template>

<style lang="scss">

</style>
