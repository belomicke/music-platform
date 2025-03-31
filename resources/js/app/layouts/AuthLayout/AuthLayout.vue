<script setup lang="ts">
import { watch } from "vue"
import { useRoute } from "vue-router"
import { IButton } from "@/shared/ui"
import { useNavigation } from "@/shared/hooks"

const route = useRoute()
const { goToHomePage } = useNavigation()

watch(route, () => {
    const el = document.getElementById("app")

    el.scrollTo(0, 0)
})
</script>

<template>
    <div class="auth-layout">
        <div class="auth-layout-header">
            <i-button
                icon="close"
                @click="goToHomePage"
            />
        </div>
        <div class="auth-layout-content">
            <router-view></router-view>
        </div>
        <div class="auth-layout-footer"/>
    </div>
</template>

<style lang="scss">
.auth-layout {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;

    width: 100%;
    height: 100%;

    &-header {
        display: flex;
        justify-content: end;
        align-items: center;
        padding: 0 20px;
        height: 64px;
        width: 100%;
    }

    &-content {
        border: 1px solid var(--color-border);
        padding: 20px;
        border-radius: 6px;

        margin: 0 auto;
        width: 100%;

        @media (max-width: 576px) {
            width: 100%;
            padding: 20px;

            border-radius: 0;
            border: none;
        }

        @media (min-width: 576px) {
            max-width: 465px;
        }
    }

    &-footer {
        height: 76px;
        width: 100%;
    }
}
</style>
