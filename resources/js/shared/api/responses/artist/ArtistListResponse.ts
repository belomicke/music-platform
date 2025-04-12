import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { IArtist } from "@/shared/api"

export type ArtistListResponseData = ApiResponse<{
    artists: IArtist[]
}>

export type ArtistListResponse = AxiosResponse<ArtistListResponseData>
