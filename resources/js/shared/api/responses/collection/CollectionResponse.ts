import type { AxiosResponse } from "axios"
import type { ApiCompactArtist, ApiRelease, ApiResponse } from "@/shared/api"

export type CollectionResponseData = ApiResponse<{
    artists: {
        items: ApiCompactArtist[]
        count: number
    }
    releases: {
        items: ApiRelease[]
        count: number
    }
}>

export type CollectionResponse = AxiosResponse<CollectionResponseData>
