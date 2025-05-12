import type { ArtistResponse, CompactArtistListResponse, StatusResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const artistsMethods = {
    getById: async (id: string): Promise<ArtistResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists/${id}`,
        })
    },
    getPopular: async (): Promise<CompactArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/artists`,
        })
    },
    getFavorite: async (offset: number): Promise<CompactArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/artists`,
            data: {
                offset,
            },
        })
    },
    follow: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: `/api/artists/${id}/follow`,
        })
    },
    unfollow: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: `/api/artists/${id}/unfollow`,
        })
    },
}
