import type { ArtistResponse, CompactArtistListResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const artistsMethods = {
    getById: async (id: string): Promise<ArtistResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists/${id}`,
        })
    },
    popular: async (): Promise<CompactArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists`,
        })
    },
}
