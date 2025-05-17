<script setup lang="ts">
import { useI18n } from "vue-i18n"

const { t } = useI18n()
</script>

<template>
    <div class="recent-searches">
        {{ t("page.search.recent-searches.note") }}
    </div>
</template>

<style scoped lang="scss">
.recent-searches {
    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 16px;
    font-weight: 500;
    color: var(--color-text-secondary);

    width: 100%;
    height: 100%;
}
</style>
