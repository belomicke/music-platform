import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ApiUser } from "@/shared/api"

export type UserResponseData = ApiResponse<{
    user: ApiUser
}>

export type UserResponse = AxiosResponse<UserResponseData>
