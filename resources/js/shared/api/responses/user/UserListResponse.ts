import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import type { ApiUser } from "@/shared/api"

export type UserListResponseData = ApiResponse<{
    users: ApiUser[]
    count: number
}>

export type UserListResponse = AxiosResponse<UserListResponseData>
