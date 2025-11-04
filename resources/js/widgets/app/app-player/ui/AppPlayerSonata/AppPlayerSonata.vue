<script setup lang="ts">
import AppPlayerSonataControls from "./AppPlayerSonataControls.vue"
import AppPlayerSonataTimecode from "./AppPlayerSonataTimecode.vue"
import AppPlayerSonataPlayMode from "./AppPlayerSonataPlayMode.vue"
</script>

<template>
    <div class="app-player-sonata">
        <div class="sonata-controls">
            <app-player-sonata-controls/>
            <app-player-sonata-play-mode/>
        </div>
        <app-player-sonata-timecode/>
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
