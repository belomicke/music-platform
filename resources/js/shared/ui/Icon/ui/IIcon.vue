<script setup lang="ts">
import { computed } from "vue"
import {
    AddUserIcon,
    AppLogoIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
    CloseIcon,
    HeartIcon,
    HomeIcon,
    LoaderIcon,
    LogInIcon,
    LogOutIcon,
    MusicalNoteIcon,
    MusicIcon,
    NextIcon,
    PauseIcon,
    PencilIcon,
    PlayIcon,
    PreviousIcon,
    RepeatIcon,
    RepeatOneIcon,
    SearchIcon,
    UserIcon,
    VolumeIcon,
    VolumeOffIcon,
} from "./icons"
import { IconName } from "../types"

export interface IIconProps {
    icon: IconName
    size?: number
    filled?: boolean
}

const props = withDefaults(defineProps<IIconProps>(), {
    size: 24,
    filled: false,
})

const iconComponent = computed(() => {
    return {
        "add-user": AddUserIcon,
        "app-logo": AppLogoIcon,
        "chevron-left": ChevronLeftIcon,
        "chevron-right": ChevronRightIcon,
        "close": CloseIcon,
        "heart": HeartIcon,
        "home": HomeIcon,
        "loader": LoaderIcon,
        "log-in": LogInIcon,
        "log-out": LogOutIcon,
        "musical-note": MusicalNoteIcon,
        "music": MusicIcon,
        "next": NextIcon,
        "pause": PauseIcon,
        "pencil": PencilIcon,
        "play": PlayIcon,
        "previous": PreviousIcon,
        "repeat": RepeatIcon,
        "repeat-one": RepeatOneIcon,
        "search": SearchIcon,
        "user": UserIcon,
        "volume": VolumeIcon,
        "volume-off": VolumeOffIcon,
    }[props.icon]
})
</script>

<template>
    <component
        :is="iconComponent"
        :width="size"
        :height="size"
        :filled="filled"
    />
</template>

<style>

</style>
