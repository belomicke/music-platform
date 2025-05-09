<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { UserAvatar } from "@/entities/user"
import { useNavigation } from "@/shared/hooks"
import { MediaPageHeader } from "@/shared/ui"
import { ApiUser } from "@/shared/api"

const props = defineProps<{
    user: ApiUser
}>()

const { t } = useI18n()

const { goToUserFollowersPage } = useNavigation()

const followersCountClickHandler = () => {
    goToUserFollowersPage(props.user.id)
}
</script>

<template>
    <media-page-header
        :title="user.name"
        :type="t('page.user.info-page.header.type')"
        v-if="user"
    >
        <template #subtitle>
            <div class="user-page-header__subtitle">
                <div
                    class="followed-artists-count"
                    @click="followersCountClickHandler"
                    v-if="user.followers_count > 0"
                >
                    {{ t("followers", user.followers_count) }}
                </div>
            </div>
        </template>
        <template #avatar>
            <user-avatar
                :id="user.id"
                :size="232"
                can-be-open-in-modal
            />
        </template>
    </media-page-header>
</template>

<style lang="scss">
.user-page-header {
    &__subtitle {
        display: flex;
    }
}

.followed-artists-count {
    cursor: pointer;
    font-size: 14px;

    &:hover {
        text-decoration: underline;
    }
}
</style>
