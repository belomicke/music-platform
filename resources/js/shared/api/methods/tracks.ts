import type { TrackListResponse } from "@/shared/api"
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
}
