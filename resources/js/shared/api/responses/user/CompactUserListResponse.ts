import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import type { ApiCompactUser } from "@/shared/api"

export type CompactUserListResponseData = ApiResponse<{
    users: ApiCompactUser[]
    count: number
}>

export type CompactUserListResponse = AxiosResponse<CompactUserListResponseData>
