import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import type { ApiArtist, ApiRelease } from "@/shared/api"

export type ArtistResponseData = ApiResponse<{
    artist: ApiArtist
    releases: {
        items: ApiRelease[]
        count: number
    }
}>

export type ArtistResponse = AxiosResponse<ArtistResponseData>
