import { ApiSearchResponse, makeRequest, SearchType } from "@/shared/api"

export const searchMethods = {
    search: async (
        query: string,
        type: SearchType,
        bestResults: boolean,
    ): Promise<ApiSearchResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/search",
            data: {
                query,
                type,
                bestResults,
            },
        })
    },
}
