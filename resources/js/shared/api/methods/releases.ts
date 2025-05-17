import type { ReleaseResponse, StatusResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const releasesMethods = {
    getById: async (id: string): Promise<ReleaseResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/releases/${id}`,
        })
    },
    follow: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: `/api/releases/${id}/follow`,
        })
    },
    unfollow: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: `/api/releases/${id}/unfollow`,
        })
    },
}
