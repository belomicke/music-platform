import type { AxiosResponse } from "axios"
import type { ApiResponse, ApiTrack } from "@/shared/api"

export type TrackListResponseData = ApiResponse<{
    tracks: ApiTrack[]
}>

export type TrackListResponse = AxiosResponse<TrackListResponseData>
