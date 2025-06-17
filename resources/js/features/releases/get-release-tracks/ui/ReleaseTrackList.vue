<script setup lang="ts">
import { computed } from "vue"
import { useReleaseTracks } from "@/features/releases/get-release-tracks"
import { TrackList } from "@/entities/track"

const props = defineProps<{
    id: string
}>()

const id = computed(() => props.id)

const { data: tracks } = useReleaseTracks(id)

const queueId = computed(() => {
    return `release:${id.value}`
})
</script>

<template>
    <track-list
        :ids="tracks.map(track => track?.id)"
        :queue-id="queueId"
        with-index
        v-if="tracks.length"
    />
</template>
