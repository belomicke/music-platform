import { ApiRecentSearch, ApiResponse } from "@/shared/api"
import { AxiosResponse } from "axios"

export type ApiRecentSearchesResponseData = ApiResponse<{
    recent_searches: ApiRecentSearch[]
}>

export type ApiRecentSearchesReponse = AxiosResponse<ApiRecentSearchesResponseData>
