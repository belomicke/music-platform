import { ApiSearchResponse, makeRequest } from "@/shared/api"

export const searchMethods = {
    search: async (
        query: string,
    ): Promise<ApiSearchResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/search",
            data: {
                query,
            },
        })
    },
}
