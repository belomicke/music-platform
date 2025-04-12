import { type ArtistListResponse, type ArtistResponse, makeRequest } from "@/shared/api"

export const artistsMethods = {
    byId: async (id: string): Promise<ArtistResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists/${id}`,
        })
    },
    popular: async (): Promise<ArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists`,
        })
    },
}
