<script setup lang="ts">
import { computed } from "vue"
import {
    AddUserIcon,
    AppLogoIcon,
    ArtistIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
    CloseIcon,
    CollectionIcon,
    HeartIcon,
    HomeIcon,
    LoaderIcon,
    LogInIcon,
    LogOutIcon,
    MusicIcon,
    NextIcon,
    PauseIcon,
    PencilIcon,
    PlayIcon,
    PreviousIcon,
    ReleaseIcon,
    RepeatIcon,
    RepeatOneIcon,
    SearchIcon,
    UserIcon,
    VolumeIcon,
    VolumeOffIcon,
} from "./icons"
import { type IconName } from "../types"
import { type UiSize } from "@/shared/ui"

export interface IIconProps {
    icon: IconName
    size?: UiSize
    filled?: boolean
}

const props = withDefaults(defineProps<IIconProps>(), {
    filled: false,
    size: "s",
})

const iconComponent = computed(() => {
    return {
        "add-user": AddUserIcon,
        "app-logo": AppLogoIcon,
        "artist": ArtistIcon,
        "chevron-left": ChevronLeftIcon,
        "chevron-right": ChevronRightIcon,
        "close": CloseIcon,
        "collection": CollectionIcon,
        "heart": HeartIcon,
        "home": HomeIcon,
        "loader": LoaderIcon,
        "log-in": LogInIcon,
        "log-out": LogOutIcon,
        "music": MusicIcon,
        "next": NextIcon,
        "pause": PauseIcon,
        "pencil": PencilIcon,
        "play": PlayIcon,
        "previous": PreviousIcon,
        "release": ReleaseIcon,
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
        class="i-icon"
        :class="[
            size
        ]"
        :filled="filled"
    />
</template>

<style lang="scss">
.i-icon {
    fill: currentColor;

    &.xxxs {
        width: var(--ym-icon-size-xxxs);
        height: var(--ym-icon-size-xxxs);
    }

    &.xxs {
        width: var(--ym-icon-size-xxs);
        height: var(--ym-icon-size-xxs);
    }

    &.xs {
        width: var(--ym-icon-size-xs);
        height: var(--ym-icon-size-xs);
    }

    &.s {
        width: var(--ym-icon-size-s);
        height: var(--ym-icon-size-s);
    }

    &.m {
        width: var(--ym-icon-size-m);
        height: var(--ym-icon-size-m);
    }

    &.l {
        width: var(--ym-icon-size-l);
        height: var(--ym-icon-size-l);
    }

    &.xl {
        width: var(--ym-icon-size-xl);
        height: var(--ym-icon-size-xl);
    }

    &.xxl {
        width: var(--ym-icon-size-xxl);
        height: var(--ym-icon-size-xxl);
    }

    &.xxxl {
        width: var(--ym-icon-size-xxxl);
        height: var(--ym-icon-size-xxxl);
    }
}
</style>
