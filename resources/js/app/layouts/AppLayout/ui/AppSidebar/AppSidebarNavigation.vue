<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import { useI18n } from "vue-i18n"
import { useCurrentUser } from "@/features/auth/current-user"
import { ROUTE_NAME, ROUTE_NAMES } from "@/shared/config/router"
import { useNavigation } from "@/shared/hooks"
import { IconName, IIcon } from "@/shared/ui"

interface Option {
    id: ROUTE_NAME
    text: string
    isActive: boolean
    icon: IconName | ""
}

const { t } = useI18n()

const route = useRoute()
const { goToHomePage, goToSearchPage, goToCollectionPage } = useNavigation()

const { isAuth } = useCurrentUser()

const activeOption = computed(() => {
    switch (route.path) {
        case "/":
            return ROUTE_NAMES.HOME
        case "/search":
            return ROUTE_NAMES.SEARCH
        case "/collection":
            return ROUTE_NAMES.COLLECTION
    }
})

const options = computed((): Option[] => {
    const result: Option[] = [
        {
            id: "home",
            text: t("layouts.app.sidebar.navigation.options.home"),
            isActive: activeOption.value === ROUTE_NAMES.HOME,
            icon: "home",
        },
        {
            id: "search",
            text: t("layouts.app.sidebar.navigation.options.search"),
            isActive: activeOption.value === ROUTE_NAMES.SEARCH,
            icon: "search",
        },
    ]

    if (isAuth.value) {
        result.push({
            id: "collection",
            text: t("layouts.app.sidebar.navigation.options.collection"),
            isActive: activeOption.value === ROUTE_NAMES.COLLECTION,
            icon: "musical-note",
        })
    }

    return result
})

const clickOnNavigationOptionHandler = (id: ROUTE_NAME) => {
    switch (id) {
        case ROUTE_NAMES.HOME:
            goToHomePage()
            break
        case ROUTE_NAMES.SEARCH:
            goToSearchPage()
            break
        case ROUTE_NAMES.COLLECTION:
            goToCollectionPage()
            break
    }
}
</script>

<template>
    <div class="app-sidebar-navigation">
        <div
            class="app-sidebar-navigation__option"
            :class="[
                option.isActive && 'active'
            ]"

            @click="clickOnNavigationOptionHandler(option.id)"

            v-for="option in options"
            :key="option.id"
        >
            <i-icon
                :icon="option.icon"
                v-if="option.icon"
            />
            <span>{{ option.text }}</span>
        </div>
    </div>
</template>

<style lang="scss">
.app-sidebar-navigation {
    display: flex;
    flex-direction: column;
    gap: 4px;

    &__option {
        display: flex;
        align-items: center;
        gap: 12px;

        font-size: 18px;
        font-weight: 500;
        padding: 6px 12px;
        height: 48px;

        color: var(--color-text-secondary);

        transition: color .15s;

        &:hover {
            cursor: pointer;
            color: var(--color-text-secondary-hover);
        }

        &.active {
            color: var(--color-text-primary);
        }

        @media (max-width: 1024px) {
            justify-content: center;

            & > span {
                display: none;
            }
        }
    }
}
</style>
