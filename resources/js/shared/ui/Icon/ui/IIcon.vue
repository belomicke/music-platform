<script setup lang="ts">
import { computed } from "vue"
import AppLogoIcon from "./icons/AppLogoIcon.vue"
import CloseIcon from "./icons/CloseIcon.vue"
import LoaderIcon from "./icons/LoaderIcon.vue"
import { IconName } from "../types/IconName"

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
