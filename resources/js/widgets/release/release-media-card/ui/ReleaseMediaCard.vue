<script setup lang="ts">
import { computed } from "vue"
import { storeToRefs } from "pinia"
import { ReleaseFollowButton } from "../../release-follow-button"
import { ReleasePlayButton } from "../../release-play-button"
import ReleaseMediaCardInfo from "./ReleaseMediaCardInfo.vue"
import { ReleaseCover, useReleaseStore } from "@/entities/release"
import { useNavigation } from "@/shared/hooks"

const props = defineProps<{
    id: string
}>()

const emit = defineEmits(["click"])

const releaseStore = useReleaseStore()
const { getReleaseById } = storeToRefs(releaseStore)

const id = computed(() => props.id)
const release = computed(() => getReleaseById.value(id.value))

const { goToReleaseInfoPage } = useNavigation()

const clickOnCoverHandler = () => {
    emit("click")
    goToReleaseInfoPage(id.value)
}
</script>

<template>
    <div
        class="release-media-card"
        v-if="release"
    >
        <release-cover
            :url="release.image_url"
            @click="clickOnCoverHandler"
            with-overlay
            clickable
        >
            <template #overlay-bottom-left>
                <release-play-button
                    :release="release"
                    compact
                />
            </template>
            <template #overlay-bottom-right>
                <release-follow-button
                    :id="release.id"
                    variant="ghost"
                />
            </template>
        </release-cover>
        <release-media-card-info
            :release="release"
        />
    </div>
</template>

<style scoped lang="scss">
.release-media-card {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}
</style>
