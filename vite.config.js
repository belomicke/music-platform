import {defineConfig} from "vite"
import laravel from "laravel-vite-plugin"
import vue from "@vitejs/plugin-vue"

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/index.ts"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js/",
        },
    },
    optimizeDeps: {
        include: ["lodash.debounce"]
    }
})

