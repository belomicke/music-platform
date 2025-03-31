<script setup lang="ts">
import { IFormContainer } from "@/shared/ui"
import { useNavigation } from "@/shared/hooks"

defineProps<{
    title: string
}>()

const { goToHomePage } = useNavigation()
</script>

<template>
    <i-form-container
        :title="title"
        @click-on-logo="goToHomePage"
    >
        <slot></slot>
    </i-form-container>
</template>
