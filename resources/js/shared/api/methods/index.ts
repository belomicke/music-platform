import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { collectionMethods } from "./collection"
import { meMethods } from "./me"
import { releasesMethods } from "./releases"

import { makeRequest } from "@/shared/api"
import { ApiSearchResponse } from "@/shared/api/responses/global/ApiSearchResponse"
import { SearchType } from "@/features/search"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    collection: collectionMethods,
    me: meMethods,
    releases: releasesMethods,

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
