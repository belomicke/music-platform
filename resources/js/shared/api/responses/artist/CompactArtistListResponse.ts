import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ApiCompactArtist } from "@/shared/api"

export type CompactArtistListResponseData = ApiResponse<{
    artists: ApiCompactArtist[]
    count: number
}>

export type CompactArtistListResponse = AxiosResponse<CompactArtistListResponseData>
