<script setup lang="ts">
import { onMounted, ref, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useCurrentUser } from "@/features/auth/current-user"
import { IIconButton } from "@/shared/ui"

const route = useRoute()
const router = useRouter()

const { isAuth } = useCurrentUser()

const canGoBack = ref<boolean | undefined>(undefined)
const canGoForward = ref<boolean | undefined>(undefined)

watch(route, () => {
    getHistoryState()
})

onMounted(() => {
    getHistoryState()
})

const getHistoryState = () => {
    const back = window.history.state.back
    const forward = window.history.state.forward

    if (isAuth.value && back !== null && back.startsWith("/auth")) {
        canGoBack.value = false
    } else {
        canGoBack.value = window.history.state.back !== null
    }

    if (isAuth.value && forward !== null && forward.startsWith("/auth")) {
        canGoForward.value = false
    } else {
        canGoForward.value = window.history.state.forward !== null
    }
}

const goBackHandler = () => {
    router.back()
}

const goForwardHandler = () => {
    router.forward()
}
</script>

<template>
    <div class="media-page-sticky-header">
        <div class="media-page-sticky-header__navigation">
            <i-icon-button
                icon="chevron-left"
                variant="ghost"

                :disabled="!canGoBack"
                @click="goBackHandler"
            />
            <i-icon-button
                icon="chevron-right"
                variant="ghost"

                :disabled="!canGoForward"
                @click="goForwardHandler"
            />
        </div>
    </div>
</template>

<style lang="scss">
.media-page-sticky-header {
    display: flex;
    padding: 12px 24px;
    background-color: rgba(20, 20, 20, .8);
    backdrop-filter: blur(12px);

    position: sticky;
    top: 0;
    z-index: 1;

    &__navigation {
        display: flex;
        gap: 8px;
    }
}
</style>
