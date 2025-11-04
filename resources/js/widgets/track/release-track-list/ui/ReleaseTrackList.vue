<script setup lang="ts">
import { computed } from "vue"
import { TrackList } from "../../track-list"
import { useReleaseTracks } from "@/features/releases/get-release-tracks"

const props = defineProps<{
    id: string
}>()

const id = computed(() => props.id)

const { data: tracks } = useReleaseTracks(id)

const contextId = computed(() => {
    return `release:${id.value}`
})
</script>

<template>
    <div class="release-track-list">
        <track-list
            :tracks="tracks"
            :context-id="contextId"
            v-if="tracks.length"
        />
    </div>
</template>

<style lang="scss">
.release-track-list {
    padding: 0 var(--ym-spacer-size-l);
}
</style>
