import type { UserResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const usersMethods = {
    getById: async (id: string): Promise<UserResponse> => {
        return await makeRequest({
            method: "GET",
            url: `/api/users/${id}`,
        })
    },
}
