import type { AxiosResponse } from "axios"
import type { ApiCompactArtist, ApiRelease, ApiResponse, ApiTrack } from "@/shared/api"

export type CollectionResponseData = ApiResponse<{
    artists: {
        items: ApiCompactArtist[]
        count: number
    }
    releases: {
        items: ApiRelease[]
        count: number
    }
    tracks: {
        items: ApiTrack[]
        count: number
    }
}>

export type CollectionResponse = AxiosResponse<CollectionResponseData>
