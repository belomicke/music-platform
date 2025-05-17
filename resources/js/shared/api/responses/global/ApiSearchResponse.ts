import { AxiosResponse } from "axios"
import { ApiCompactArtist, ApiRelease, ApiResponse } from "@/shared/api"

export type ApiSearchResponseData = ApiResponse<{
    artists: ApiCompactArtist[]
    releases: ApiRelease[]
}>

export type ApiSearchResponse = AxiosResponse<ApiSearchResponseData>
