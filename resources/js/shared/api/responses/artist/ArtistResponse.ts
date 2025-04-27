import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { type ApiArtist } from "@/shared/api"

export type ArtistResponseData = ApiResponse<{
    artist: ApiArtist
}>

export type ArtistResponse = AxiosResponse<ArtistResponseData>
