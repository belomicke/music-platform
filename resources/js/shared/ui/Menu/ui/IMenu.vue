<script setup lang="ts">
import { IconName, IIcon } from "@/shared/ui"

interface IMenuOption {
    text: string
    icon?: IconName
    onClick?: () => void
}

defineProps<{
    options: IMenuOption[]
}>()

</script>

<template>
    <div class="i-menu">
        <div
            class="i-menu__option"
            v-for="(option, index) in options"
            @click="option.onClick"
            :key="index"
        >
            <i-icon
                class="i-menu__icon"
                :icon="option.icon"
                v-if="option.icon"
            />
            {{ option.text }}
        </div>
    </div>
</template>

<style lang="scss">
.i-menu {
    background-color: rgb(33, 33, 33, 0.867);
    backdrop-filter: blur(10px);
    box-shadow: 0 .25rem .5rem .125rem rgb(16, 16, 16, 0.612);

    padding: 10px 0;
    border-radius: 6px;
    min-width: 200px;

    &__option {
        display: flex;
        align-items: center;

        line-height: 1.5;
        white-space: nowrap;
        color: var(--color-text);

        font-size: .875rem;
        margin: .125rem .25rem;
        padding: .25rem .75rem;
        border-radius: .375rem;
        font-weight: 500;
        user-select: none;

        cursor: pointer;

        &:hover {
            background-color: rgb(0, 0, 0, 0.4);
        }
    }

    &__icon {
        max-width: 1.25rem;
        font-size: 1.25rem;
        margin-inline: .5rem 1.25rem;

        color: rgb(170, 170, 170);
    }
}
</style>
