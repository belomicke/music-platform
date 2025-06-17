import { ApiResponse, ApiTrack, makeRequest } from "@/shared/api"
import { AxiosResponse } from "axios"

type PlayerStateResponseData = ApiResponse<{
    context_id: string
    position: number
    track_id: string
    length: number
    track: ApiTrack
}>

type PlayerStateResponse = AxiosResponse<PlayerStateResponseData>

export const playerMethods = {
    init: async (): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/player/init",
        })
    },
    setTrack: async (context_id: string, position: number): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/player",
            data: {
                context_id,
                position,
            },
        })
    },
    setContext: async (context_id: string): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/player/context",
            data: {
                context_id,
            },
        })
    },
}
