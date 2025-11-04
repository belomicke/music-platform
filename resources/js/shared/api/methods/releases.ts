import type { ReleaseResponse, TrackListResponse } from "@/shared/api"
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
}
