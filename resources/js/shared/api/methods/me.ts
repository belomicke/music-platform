import type { CurrentUserResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const meMethods = {
    get: async (): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/me",
        })
    },
}
