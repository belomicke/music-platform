import type { CurrentUserResponse, StatusResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const meMethods = {
    get: async (): Promise<CurrentUserResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/me",
        })
    },
    followArtist: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: `/api/me/following`,
            data: {
                id,
                type: "artist",
            },
        })
    },
    unfollowArtist: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: `/api/me/following`,
            data: {
                id,
                type: "artist",
            },
        })
    },
    followUser: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "PUT",
            url: `/api/me/following`,
            data: {
                id,
                type: "user",
            },
        })
    },
    unfollowUser: async (id: string): Promise<StatusResponse> => {
        return makeRequest({
            method: "DELETE",
            url: `/api/me/following`,
            data: {
                id,
                type: "user",
            },
        })
    },
}
