<script setup lang="ts">
import { computed } from "vue"
import { AppLogoIcon, CloseIcon, LoaderIcon, MusicIcon, UserIcon } from "./icons"
import { IconName } from "../types"

interface IIconProps {
    icon: IconName
    size?: number
}

const props = withDefaults(defineProps<IIconProps>(), {
    size: 24,
})

const iconComponent = computed(() => {
    return {
        "app-logo": AppLogoIcon,
        "close": CloseIcon,
        "loader": LoaderIcon,
        "music": MusicIcon,
        "user": UserIcon,
    }[props.icon]
})
</script>

<template>
    <component
        :is="iconComponent"
        :width="size"
        :height="size"
    />
</template>

<style>

</style>
