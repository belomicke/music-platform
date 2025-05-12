import type { CurrentUserResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const meMethods = {
    get: async (): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/me",
        })
    },
    editAccountInfo: async (data: FormData): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/me",
            data,
        })
    },
}
