<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { useClearRecentSearches } from "@/features/recent-searches/clear-recent-searches"
import { useRecentSearches } from "@/features/recent-searches/get-recent-searches"
import { RecentSearchItem } from "@/entities/recent-search"
import { IButton, ILoader } from "@/shared/ui"

const { t } = useI18n()
const { data, isLoading } = useRecentSearches()

const { fetch: clearRecentSearches } = useClearRecentSearches()

const clearRecentSearchesHandler = () => {
    clearRecentSearches()
}
</script>

<template>
    <div class="recent-searches">
        <div
            class="recent-searches__empty"
            v-if="data.length === 0"
        >
            {{ t("page.search.recent-searches.note") }}
        </div>
        <div
            class="recent-searches__loader"
            v-else-if="isLoading"
        >
            <i-loader
                :size="32"
            />
        </div>
        <template v-else>
            <div class="recent-searches-content">
                <div class="recent-searches-content__title">История поиска</div>
                <div class="recent-searches__items">
                    <div
                        class="recent-searches__item"
                        v-for="item in data"
                        :key="item.id"
                    >
                        <recent-search-item
                            :recent-search="item"
                        />
                    </div>
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

<style scoped lang="scss">
.recent-searches {
    padding: 0 24px 24px;
    font-size: 16px;
    font-weight: 500;

    width: 100%;
    height: 100%;

    &__empty {
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--color-text-secondary);
        height: 100%;
    }

    &__loader {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    &-content {
        display: flex;
        flex-direction: column;
        gap: 12px;

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
    }
}
</style>
