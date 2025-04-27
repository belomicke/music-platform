import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { type ApiArtist } from "@/shared/api"

export type ArtistListResponseData = ApiResponse<{
    artists: ApiArtist[]
    count: number
}>

export type ArtistListResponse = AxiosResponse<ArtistListResponseData>
