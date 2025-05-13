import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { meMethods } from "./me"

import { makeRequest } from "@/shared/api"
import { ApiSearchResponse } from "@/shared/api/responses/global/ApiSearchResponse"
import { SearchType } from "@/features/search/api/useSearch"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    me: meMethods,

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
