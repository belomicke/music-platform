import type { AxiosResponse } from "axios"
import type { ApiArtist, ApiRelease, ApiResponse, ApiTrack } from "@/shared/api"

export type CollectionResponseData = ApiResponse<{
    artists: {
        items: ApiArtist[]
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
