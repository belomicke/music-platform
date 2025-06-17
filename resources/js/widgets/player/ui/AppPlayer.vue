<script setup lang="ts">
import { useBackendPlayerStore } from "@/entities/backend-player"
import { storeToRefs } from "pinia"
import { AppPlayerSonata } from "./AppPlayerSonata"
import AppPlayerInfo from "./AppPlayerInfo.vue"
import AppPlayerMeta from "./AppPlayerMeta.vue"

const backendPlayerStore = useBackendPlayerStore()
const { getTrack: track } = storeToRefs(backendPlayerStore)
</script>

<template>
    <div class="app-player" v-if="track">
        <app-player-info
            :track="track"
        />
        <app-player-sonata
            :track="track"
        />
        <app-player-meta/>
    </div>
</template>

<style lang="scss">
.app-player {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: space-between;
    align-items: center;
    padding: 0 8px;
    height: 100%;
    background-color: var(--color-background);
    border: 1px solid var(--color-border);
    border-radius: 12px;
}
</style>
