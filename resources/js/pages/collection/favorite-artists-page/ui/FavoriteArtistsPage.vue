<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { FavoriteArtistsList } from "@/features/collection/favorite-artists"
import { useCurrentUser } from "@/features/auth/current-user"
import { MediaListPage, setStickyHeaderTitle } from "@/shared/ui"
import { onMounted, onUnmounted } from "vue"

const { t } = useI18n()

const { data: user } = useCurrentUser()

onMounted(() => {
    setStickyHeaderTitle(t("page.user.followed-artists.header.title"))
})

onUnmounted(() => {
    setStickyHeaderTitle("")
})
</script>

<template>
    <media-list-page
        :title="t('page.user.followed-artists.header.title')"
        v-if="user"
    >
        <favorite-artists-list
            :id="user.id"
        />
    </media-list-page>
</template>

<style lang="scss">

</style>
