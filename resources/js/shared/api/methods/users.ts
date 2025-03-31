import { makeRequest, type UserResponse } from "@/shared/api"

export const usersMethods = {
    getUserById: async (id: string): Promise<UserResponse> => {
        return await makeRequest({
            method: "GET",
            url: `/api/users/${id}`,
        })
    },
}
