import type { CollectionResponse, CompactArtistListResponse, ReleaseListResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const collectionMethods = {
    get: async (): Promise<CollectionResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection`,
        })
    },
    getFavoriteArtists: async (offset: number): Promise<CompactArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/artists`,
            data: {
                offset,
            },
        })
    },
    getFavoriteReleases: async (offset: number): Promise<ReleaseListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/releases`,
            data: {
                offset,
            },
        })
    },
}
