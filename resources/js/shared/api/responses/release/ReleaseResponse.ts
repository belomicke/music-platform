import { AxiosResponse } from "axios"
import { ApiResponse } from "../global"
import type { ApiRelease } from "@/shared/api"

export type ReleaseResponseData = ApiResponse<{
    release: ApiRelease
}>

export type ReleaseResponse = AxiosResponse<ReleaseResponseData>
