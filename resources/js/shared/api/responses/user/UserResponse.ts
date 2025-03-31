import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { IUser } from "@/shared/api"

export type UserResponseData = ApiResponse<{
    user: IUser
}>

export type UserResponse = AxiosResponse<UserResponseData>
