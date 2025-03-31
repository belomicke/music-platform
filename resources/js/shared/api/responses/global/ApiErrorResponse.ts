import { AxiosError } from "axios"

export interface ApiErrorResponseData {
    success: false
    message: string
}

export type ApiErrorResponse = AxiosError<ApiErrorResponseData>
