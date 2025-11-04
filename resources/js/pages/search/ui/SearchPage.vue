<script setup lang="ts">
import { computed } from "vue"
import { useRoute } from "vue-router"
import SearchPageResults from "./SearchPageResults.vue"
import SearchPageHeader from "./SearchPageHeader.vue"
import { RecentSearches } from "./RecentSearches"
import { AppStickyHeaderContent } from "@/widgets/app/app-sticky-header"

const route = useRoute()

const query = computed(() => {
    return route.query.q as string ?? ""
})
</script>

<template>
    <app-sticky-header-content>
        <search-page-header/>
    </app-sticky-header-content>
    <div class="search-page">
        <div class="search-page-content">
            <search-page-results
                :query="query"
                v-if="query.length"
            />
            <recent-searches v-else/>
        </div>
    </div>
</template>

<style lang="scss">
.search-page {
    display: flex;
    flex-direction: column;
    position: relative;
    height: 100%;

    &-content {
        height: 100%;
    }
}
</style>
