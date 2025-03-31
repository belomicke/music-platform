import axios from "axios"

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

axios.interceptors.response.use(async (res) => {
    if (res.status === 419) {
        await axios.get("/sanctum/csrf-cookie")
    }

    return res
})
