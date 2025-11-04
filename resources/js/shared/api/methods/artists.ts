import type { ArtistListResponse, ArtistResponse, ReleaseListResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const artistsMethods = {
    getById: async (id: string): Promise<ArtistResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists/${id}`,
        })
    },
    getPopular: async (): Promise<ArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists`,
        })
    },
    getReleases: async (id: string): Promise<ReleaseListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists/${id}/releases`,
        })
    },
}
