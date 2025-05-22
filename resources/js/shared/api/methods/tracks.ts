import type { StatusResponse, TrackListResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const trackMethods = {
    get: async (ids: string[]): Promise<TrackListResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/tracks",
            data: {
                track_ids: ids,
            },
        })
    },
    addToFavorite: async (id: string): Promise<StatusResponse> => {
        return await makeRequest({
            method: "PUT",
            url: `/api/tracks/${id}/favorite`,
        })
    },
    removeFromFavorite: async (id: string): Promise<StatusResponse> => {
        return await makeRequest({
            method: "DELETE",
            url: `/api/tracks/${id}/favorite`,
        })
    },
}
