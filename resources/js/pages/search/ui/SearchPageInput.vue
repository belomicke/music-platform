<script setup lang="ts">
import { ref, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import _ from "lodash"

const { t } = useI18n()

const route = useRoute()
const router = useRouter()

const query = ref<string>("q" in route.query ? route.query.q.toString() : "")

watch(query, () => {
    if (query.value === "") {
        search.cancel()
        router.push("/search")
        return
    }

    search.cancel()
    search()
})

const search = _.debounce(() => {
    router.push(`/search?q=${query.value}`)
}, 500)
</script>

<template>
    <div class="input-container">
        <input
            class="input"
            :placeholder="t('page.search.input.placeholder')"
            v-model="query"
        />
    </div>
</template>

<style scoped lang="scss">
.input-container {
    border: 1px solid var(--color-border);
    border-radius: 999px;
    height: 40px;
    overflow: hidden;
    transition: border-color .15s, background-color .15s;

    &:hover {
        border-color: var(--color-border-lighter);
    }

    &:focus-within {
        background-color: var(--color-background-hover);
        border-color: var(--color-border-lighter-hover);
    }
}

.input {
    border: none;
    outline: none;
    width: 100%;
    height: 100%;
    background-color: transparent;
    font-size: 16px;
    line-height: 1;
    font-weight: 500;

    padding: 0 20px;
}
</style>
