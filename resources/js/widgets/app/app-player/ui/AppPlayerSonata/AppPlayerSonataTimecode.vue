<script setup lang="ts">
import { storeToRefs } from "pinia"
import { useBackendPlayerStore } from "@/entities/backend-player"
import { IInputRange, ITimecode } from "@/shared/ui"

const backendPlayerStore = useBackendPlayerStore()
const {
    getCurrentTime: currentTime,
    getDuration: duration,
} = storeToRefs(backendPlayerStore)

const setCurrentTimeHandler = (value: number) => {
    setTimeout(() => backendPlayerStore.setPlayerTime(value), 0)
}
</script>

<template>
    <div class="change-timecode">
        <i-timecode
            class="change-timecode__timecode"
            :seconds="currentTime"
        />
        <i-input-range
            v-model="currentTime"
            :max="duration"
            @change="setCurrentTimeHandler"
        />
        <i-timecode
            class="change-timecode__timecode"
            :seconds="duration"
        />
    </div>
</template>

<style scoped lang="scss">
.change-timecode {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;

    &__timecode {
        cursor: default;
        font-size: 13px;
        font-weight: 500;
        opacity: 0;
        transition: opacity .15s;

        .change-timecode:hover & {
            opacity: 1;
        }
    }
}
</style>
