import type { CompactArtistListResponse, CompactUserListResponse, UserResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const usersMethods = {
    getById: async (id: string): Promise<UserResponse> => {
        return await makeRequest({
            method: "GET",
            url: `/api/users/${id}`,
        })
    },
    getFollowedArtists: async (id: string, offset: number): Promise<CompactArtistListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/users/${id}/following`,
            data: {
                offset,
                type: "artists",
            },
        })
    },
    getFollowedUsers: async (id: string, offset: number): Promise<CompactUserListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/users/${id}/following`,
            data: {
                offset,
                type: "users",
            },
        })
    },
    getFollowers: async (id: string, offset: number): Promise<CompactUserListResponse> => {
        return makeRequest({
            method: "GET",
            url: `/api/users/${id}/followers`,
            data: {
                offset,
            },
        })
    },
}
