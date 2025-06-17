<script setup lang="ts">
import { ref, watch } from "vue"
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IIconButton, InputRange } from "@/shared/ui"

const backendPlayerStore = useBackendPlayerStore()
const { getVolume: volume } = storeToRefs(backendPlayerStore)

const volumeBeforeToggle = ref<number>(volume.value)

watch(volume, () => {
    if (volume.value !== 0) {
        volumeBeforeToggle.value = volume.value
    }
})

const toggleVolumeHandler = () => {
    if (volume.value !== 0) {
        volumeBeforeToggle.value = volume.value
        backendPlayerStore.setVolume(0)
    } else {
        backendPlayerStore.setVolume(volumeBeforeToggle.value)
    }
}
</script>

<template>
    <div class="app-player-meta">
        <i-icon-button
            :icon="volume === 0 ? 'volume-off' : 'volume'"
            :icon-size="24"
            variant="transparent"
            @click="toggleVolumeHandler"
        />
        <input-range
            class="app-player-meta__volume"
            v-model="volume"
            :max="1"
            :step="0.01"
            @input="backendPlayerStore.setVolume"
        />
    </div>
</template>

<style scoped lang="scss">
.app-player-meta {
    display: flex;
    justify-self: flex-end;
    align-items: center;
    gap: 8px;
    padding-right: 24px;

    &__volume {
        width: 60px;
    }
}
</style>
