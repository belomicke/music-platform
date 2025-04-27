<script setup lang="ts">
import AuthProvider from "../providers/AuthProvider.vue"
import { AlertProvider, DialogProvider } from "@/shared/ui"
</script>

<template>
    <auth-provider>
        <dialog-provider>
            <alert-provider>
                <router-view/>
            </alert-provider>
        </dialog-provider>
    </auth-provider>
</template>

<style
    lang="scss"
    src="../styles/main.scss"
/>
