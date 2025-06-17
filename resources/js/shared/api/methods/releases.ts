import type { ReleaseResponse, StatusResponse, TrackListResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const releasesMethods = {
    getById: async (id: string): Promise<ReleaseResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/releases/${id}`,
        })
    },
    tracks: async (id: string, offset: number): Promise<TrackListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/releases/${id}/tracks`,
            data: {
                offset,
            },
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
