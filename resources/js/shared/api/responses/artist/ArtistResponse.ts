import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { IArtist } from "@/shared/api"

export type ArtistResponseData = ApiResponse<{
    artist: IArtist
}>

export type ArtistResponse = AxiosResponse<ArtistResponseData>
