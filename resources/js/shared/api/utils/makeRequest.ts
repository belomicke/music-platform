import axios, { type AxiosRequestConfig, type Method } from "axios"

interface MakeRequestConfig {
    method: Method
    url: string
    data?: object
}

export const makeRequest = async (config: MakeRequestConfig) => {
    const axiosConfig: AxiosRequestConfig = {
        method: config.method,
        url: config.url,
    }

    if (config.data) {
        switch (config.method) {
            case "GET":
                axiosConfig.params = config.data
                break
            case "POST":
                axiosConfig.data = config.data
                break
            case "PUT":
                axiosConfig.data = config.data
                break
            case "DELETE":
                axiosConfig.data = config.data
                break
        }
    }

    return axios(axiosConfig)
}
