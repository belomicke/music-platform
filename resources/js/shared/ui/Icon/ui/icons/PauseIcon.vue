<script setup lang="ts">
defineProps<{
    filled?: boolean
}>()
</script>

<template>
    <svg
        v-if="filled"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 40 40"
    >
        <path
            xmlns="http://www.w3.org/2000/svg"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20ZM15 13.125H18.75V26.875H15V13.125ZM21.25 13.125H25V26.875H21.25V13.125Z"
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
            d="M9.16668 4.58325H5.83334V15.4166H9.16668V4.58325ZM14.1667 4.58333H10.8333V15.4167H14.1667V4.58333Z"
            fill="currentColor"
        />
    </svg>
</template>

<style scoped lang="scss">

</style>
