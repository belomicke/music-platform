import { AxiosResponse } from "axios"

export type StatusResponseData = {
    success: boolean
}

export type StatusResponse = AxiosResponse<StatusResponseData>
