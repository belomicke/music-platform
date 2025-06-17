import { AxiosResponse } from "axios"
import { ApiArtist, ApiRelease, ApiResponse, ApiTrack } from "@/shared/api"

export type ApiSearchResponseData = ApiResponse<{
    artists: ApiArtist[]
    releases: ApiRelease[]
    tracks: ApiTrack[]
}>

export type ApiSearchResponse = AxiosResponse<ApiSearchResponseData>
