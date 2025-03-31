import { createApp } from "vue"
import { createI18n } from "vue-i18n"
import { createPinia } from "pinia"
import { App, router } from "@/app"
import "./bootstrap"
import ru from "@/shared/i18n/ru/ru"

const i18n = createI18n({
    locale: "ru",
    fallbackLocale: "ru",
    messages: {
        ru,
    },
})

const app = createApp(App)

app.use(router)
app.use(createPinia())
app.use(i18n)

app.mount("#app")
