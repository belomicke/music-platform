<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { useClearRecentSearches } from "@/features/recent-searches/clear-recent-searches"
import { useRecentSearches } from "@/features/recent-searches/get-recent-searches"
import SearchPageLoader from "@/pages/search/ui/SearchPageLoader.vue"
import NoRecentSearches from "@/pages/search/ui/RecentSearches/NoRecentSearches.vue"
import { RecentSearchItem } from "@/entities/recent-search"
import { IButton } from "@/shared/ui"

const { t } = useI18n()
const { data, isLoading } = useRecentSearches()

const { fetch: clearRecentSearchesHandler } = useClearRecentSearches()
</script>

<template>
    <div class="recent-searches">
        <search-page-loader
            v-if="isLoading"
        />
        <no-recent-searches
            v-else-if="data.length === 0"
        />
        <template v-else>
            <div class="recent-searches-content">
                <div class="recent-searches-content__title">История поиска</div>
                <div class="recent-searches__items">
                    <recent-search-item
                        :recent-search="item"
                        v-for="item in data"
                        :key="item.id"
                    />
                </div>
                <div class="recent-searches__actions">
                    <i-button
                        variant="secondary"
                        round
                        @click="clearRecentSearchesHandler"
                    >
                        {{ t("page.search.recent-searches.clear") }}
                    </i-button>
                </div>
            </div>
        </template>
    </div>
</template>

<style lang="scss">
.recent-searches {
    display: flex;
    padding: 0 24px 24px;
    font-size: 16px;
    font-weight: 500;
    min-height: 100%;
    height: 100%;

    &-content {
        display: flex;
        flex-direction: column;
        width: 100%;

        &__title {
            font-size: 24px;
            font-weight: 600;
            padding: 12px 0 16px;
        }
    }

    &__items {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(auto-fill, 56px);
        width: 100%;
        gap: 12px;
    }

    &__actions {
        display: flex;
        justify-content: center;
        margin-block-start: var(--ym-spacer-size-l);
    }
}
</style>
