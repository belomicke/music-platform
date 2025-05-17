import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ApiRelease } from "@/shared/api"

export type ReleaseListResponseData = ApiResponse<{
    releases: ApiRelease[]
    count: number
}>

export type ReleaseListResponse = AxiosResponse<ReleaseListResponseData>
