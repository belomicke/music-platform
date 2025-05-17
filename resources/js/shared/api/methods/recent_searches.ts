import type { ApiRecentSearchesReponse, RecentSearchType, StatusResponse } from "@/shared/api"
import { makeRequest } from "@/shared/api"

export const recentSearchesMethods = {
    get: async (): Promise<ApiRecentSearchesReponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/recent-searches",
        })
    },
    create: async (id: string, type: RecentSearchType): Promise<StatusResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/recent-searches",
            data: {
                id,
                type,
            },
        })
    },
    clear: async (): Promise<StatusResponse> => {
        return await makeRequest({
            method: "DELETE",
            url: "/api/recent-searches",
        })
    },
}
