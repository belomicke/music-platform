<script setup lang="ts">
import { useCurrentUser } from "@/features/auth/current-user"

const { user, isAuth } = useCurrentUser()
</script>

<template>
    <div class="home-page">
        Welcome, {{ isAuth ? user.name : "guest" }}!
    </div>
</template>

<style lang="scss">
.home-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    font-size: 24px;
    font-weight: 600;
}
</style>
