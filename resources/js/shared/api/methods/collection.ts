import type {
    ArtistListResponse,
    CollectionResponse,
    ReleaseListResponse,
    StatusResponse,
    TrackListResponse,
} from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const collectionMethods = {
    get: async (): Promise<CollectionResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection`,
        })
    },
    getFavoriteArtists: async (after: string): Promise<ArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/artists`,
            data: {
                after: after ? after : undefined,
            },
        })
    },
    getFavoriteReleases: async (after: string): Promise<ReleaseListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/releases`,
            data: {
                after: after ? after : undefined,
            },
        })
    },
    getFavoriteTracks: async (after: string): Promise<TrackListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/collection/tracks`,
            data: {
                after: after ? after : undefined,
            },
        })
    },
    addArtist: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: "/api/collection/artists",
            data: {
                id,
            },
        })
    },
    removeArtist: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: "/api/collection/artists",
            data: {
                id,
            },
        })
    },
    addRelease: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: "/api/collection/releases",
            data: {
                id,
            },
        })
    },
    removeRelease: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: "/api/collection/releases",
            data: {
                id,
            },
        })
    },
    addTrack: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: "/api/collection/tracks",
            data: {
                id,
            },
        })
    },
    removeTrack: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: "/api/collection/tracks",
            data: {
                id,
            },
        })
    },
}
