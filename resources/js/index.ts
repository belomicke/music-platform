import { createApp } from "vue"
import { createI18n } from "vue-i18n"
import { createPinia } from "pinia"
import "./bootstrap"
import { App, router } from "@/app"
import { ruMessages, ruPluralRule } from "@/shared/i18n/ru"

const i18n = createI18n({
    locale: "ru",
    fallbackLocale: "ru",
    pluralizationRules: {
        ru: ruPluralRule,
    },
    messages: {
        ru: ruMessages,
    },
})

const app = createApp(App)

app.use(router)
app.use(createPinia())
app.use(i18n)

app.mount("#app")
