import { RepeatState } from "./RepeatState"
import { ApiTrack } from "@/shared/api"

export interface PlayerState {
    position: number
    length: number
    repeat_state: RepeatState
    context_id: string
    track: ApiTrack
    volume: number
}
