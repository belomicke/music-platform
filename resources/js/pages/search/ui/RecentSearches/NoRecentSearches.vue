<script setup lang="ts">
import { useI18n } from "vue-i18n"

const { t } = useI18n()
</script>

<template>
    <div
        class="no-recent-searches"
    >
        {{ t("page.search.recent-searches.no-result") }}
    </div>
</template>

<style lang="scss">
.no-recent-searches {
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--ym-controls-color-primary-text-enabled);
    width: 100%;
    height: 100%;
}
</style>
