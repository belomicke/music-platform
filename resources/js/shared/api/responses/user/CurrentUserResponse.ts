import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ICurrentUser } from "@/shared/api"

export type CurrentUserResponseData = ApiResponse<{
    user: ICurrentUser
}>

export type CurrentUserResponse = AxiosResponse<CurrentUserResponseData>
