import { AxiosResponse } from "axios"
import { ApiCompactArtist, ApiResponse } from "@/shared/api"

export type ApiSearchResponseData = ApiResponse<{
    artists: ApiCompactArtist[]
}>

export type ApiSearchResponse = AxiosResponse<ApiSearchResponseData>
