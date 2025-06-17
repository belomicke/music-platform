<script setup lang="ts">
defineProps<{
    filled?: boolean
}>()
</script>

<template>
    <svg
        v-if="filled"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
    >
        <path
            xmlns="http://www.w3.org/2000/svg"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM9.75 12V7.875H10.3125C10.3125 7.875 13.125 10.4062 16.5 11.7188V12V12.2812C13.125 13.5938 10.3125 16.125 10.3125 16.125H9.75V12Z"
            fill="currentColor"
        />
    </svg>
    <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
    >
        <path
            xmlns="http://www.w3.org/2000/svg"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M6.66666 4.58325V9.99992H15.8333V9.37492C11.6667 7.91659 7.91666 4.58325 7.91666 4.58325H6.66666ZM6.66667 15.4167V10H15.8333V10.625C11.6667 12.0833 7.91667 15.4167 7.91667 15.4167H6.66667Z"
            fill="currentColor"
        />
    </svg>
</template>
