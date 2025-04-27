<script setup lang="ts">
import { computed, watchEffect } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import { UserFollowedArtistList } from "@/features/artists/user-followed-artists"
import { useUserById } from "@/features/users/user-by-id"
import { useNavigation } from "@/shared/hooks"

const { t } = useI18n()

const route = useRoute()
const { goToHomePage } = useNavigation()

const id = computed(() => {
    return route.params.id as string
})

const { user, isLoading } = useUserById(id)

watchEffect(() => {
    if (isLoading.value === false && user.value === undefined) {
        goToHomePage()
    }
})
</script>

<template>
    <div
        class="user-following-page"
        v-if="user"
    >
        <div class="user-following-page-header">
            <h1 class="user-following-page-header__title">
                {{ t("page.user.following-page.header.title", { name: user.name }) }}
            </h1>
        </div>
        <div class="user-following-page-content">
            <user-followed-artist-list
                :id="id"
                v-if="id"
            />
        </div>
    </div>
</template>

<style lang="scss">
.user-following-page {
    &-header {
        position: sticky;
        top: 0;
        z-index: 1;
        padding: 24px 24px 12px;
        background-color: var(--color-background);

        &__title {
            font-size: 32px;
            font-weight: 700;
            line-height: normal;
            margin: 0;
        }
    }

    &-content {
        padding: 12px 0 24px 24px;
    }
}
</style>
