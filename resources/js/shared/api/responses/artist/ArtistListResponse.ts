import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ApiArtist } from "@/shared/api"

export type CompactArtistListResponseData = ApiResponse<{
    artists: ApiArtist[]
    count: number
}>

export type CompactArtistListResponse = AxiosResponse<CompactArtistListResponseData>
