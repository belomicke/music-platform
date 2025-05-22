import { AxiosResponse } from "axios"
import { ApiCompactArtist, ApiRelease, ApiResponse, ApiTrack } from "@/shared/api"

export type ApiSearchResponseData = ApiResponse<{
    artists: ApiCompactArtist[]
    releases: ApiRelease[]
    tracks: ApiTrack[]
}>

export type ApiSearchResponse = AxiosResponse<ApiSearchResponseData>
