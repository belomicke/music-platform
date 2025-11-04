import { AxiosResponse } from "axios"
import { PlayerState, RepeatState } from "@/shared/api/types"
import { ApiResponse, makeRequest } from "@/shared/api"

export type PlayerStateResponseData = ApiResponse<PlayerState>
export type PlayerStateResponse = AxiosResponse<PlayerStateResponseData>

export const playerMethods = {
    init: async (): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "GET",
            url: "/api/player/state",
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
    setNextTrack: async (): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/player/next",
        })
    },
    setPreviousTrack: async (): Promise<PlayerStateResponse> => {
        return await makeRequest({
            method: "POST",
            url: "/api/player/previous",
        })
    },
    setRepeatState: async (value: RepeatState) => {
        return await makeRequest({
            method: "PUT",
            url: "/api/player/repeat",
            data: {
                state: value,
            },
        })
    },
    setVolume: async (value: number) => {
        return await makeRequest({
            method: "PUT",
            url: "/api/player/volume",
            data: {
                volume_percent: value,
            },
        })
    },
}
