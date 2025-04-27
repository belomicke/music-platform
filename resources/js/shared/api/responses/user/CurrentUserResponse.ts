import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import { ApiCurrentUser } from "@/shared/api"

export type CurrentUserResponseData = ApiResponse<{
    user: ApiCurrentUser
}>

export type CurrentUserResponse = AxiosResponse<CurrentUserResponseData>
