<script setup lang="ts">
import AppPlayerSonataControls from "./AppPlayerSonataControls.vue"
import AppPlayerSonataTimecode from "./AppPlayerSonataTimecode.vue"
import AppPlayerSonataPlayMode from "./AppPlayerSonataPlayMode.vue"
import { IIconButton } from "@/shared/ui"
import { ApiTrack } from "@/shared/api"

defineProps<{
    track: ApiTrack
}>()
</script>

<template>
    <div class="app-player-sonata">
        <div class="sonata-controls">
            <i-icon-button
                icon="heart"
                variant="transparent"
                :icon-size="24"
            />
            <app-player-sonata-controls/>
            <app-player-sonata-play-mode/>
        </div>
        <app-player-sonata-timecode
            :duration_ms="track.duration_ms"
        />
    </div>
</template>

<style scoped lang="scss">
.app-player-sonata {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 120%;
    height: 60px;
}

.sonata-controls {
    display: flex;
    gap: 32px;
    height: 40px;
}
</style>
