<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useUserById } from "@/features/users/user-by-id"
import { UserAvatar } from "@/entities/user"

const route = useRoute()

const id = computed<string>(() => {
    return route.params.id as string
})

const { user } = useUserById(id)

</script>

<template>
    <div
        class="profile-page-header"
        v-if="user"
    >
        <div class="profile-page-header__shadow"/>
        <user-avatar
            class="profile-page-header__avatar"
            :id="id"
            :size="232"
        />
        <div class="profile-page-header__info">
            <div class="profile-page-header__type">Профиль</div>
            <h1 class="profile-page-header__name">{{ user.name }}</h1>
        </div>
    </div>
</template>

<style lang="scss">
.profile-page-header {
    display: flex;
    align-items: center;
    gap: 32px;
    padding: 40px;
    background-color: rgb(120, 120, 120);
    position: relative;
    user-select: none;

    &__shadow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0, .5);
    }

    &__avatar {
        position: relative;
        z-index: 1;
    }

    &__info {
        display: flex;
        flex-direction: column;
        z-index: 1;
    }

    &__name {
        font-size: 6rem;
        line-height: 1;
        margin: 0;
    }
}
</style>
