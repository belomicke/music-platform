<script setup lang="ts">
import { computed } from "vue"
import { ReleaseMediaCard } from "../..//release-media-card"
import { ApiRelease } from "@/shared/api"
import { MediaList } from "@/shared/ui"

const props = withDefaults(defineProps<{
    releases: ApiRelease[]
    title?: string
    withTitle?: boolean
    hasMore?: boolean
    oneRow?: boolean
}>(), {
    title: "",
    withTitle: false,
    hasMore: false,
    oneRow: false,
})

const emit = defineEmits([
    "load-more",
    "click-on-item",
])

const items = computed(() => props.releases.map(release => release.id))

const loadMoreHandler = () => {
    emit("load-more")
}

const clickOnItemHandler = (id: string) => {
    emit("click-on-item", id)
}
</script>

<template>
    <media-list
        :items="items"
        :has-more="hasMore"
        :one-row="oneRow"
        @load-more="loadMoreHandler"
    >
        <template #item="{ item }">
            <release-media-card
                :id="item"
                @click="clickOnItemHandler(item)"
            />
        </template>
    </media-list>
</template>
