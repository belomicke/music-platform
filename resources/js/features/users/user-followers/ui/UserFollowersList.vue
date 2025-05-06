<script setup lang="ts">
import { computed } from "vue"
import { useI18n } from "vue-i18n"
import { useUserFollowers } from "../api/useUserFollowers"
import { UserMediaCard } from "@/entities/user"
import { useNavigation } from "@/shared/hooks"
import { MediaList } from "@/shared/ui"

const props = withDefaults(defineProps<{
    id: string
    withTitle?: boolean
    oneRow?: boolean
}>(), {
    withTitle: false,
    oneRow: false,
})

const { t } = useI18n()
const { goToUserFollowedUsersPage } = useNavigation()

const id = computed(() => props.id)

const { data: users, hasMore, getMore } = useUserFollowers(id)

const title = computed(() => {
    return props.withTitle ? t("features.user.user-followed-users.ui.users-list-title") : ""
})

const items = computed(() => users.value.map(user => user.id))

const loadMoreHandler = () => {
    getMore()
}
</script>

<template>
    <media-list
        :title="title"
        :items="items"
        :has-more="hasMore"
        :one-row="oneRow"
        @click-on-title="goToUserFollowedUsersPage(id)"
        @load-more="loadMoreHandler"
        v-if="items && hasMore !== undefined"
    >
        <template #item="{ item }">
            <user-media-card
                :id="item"
            />
        </template>
    </media-list>
</template>

<style lang="scss">

</style>
