import type { ApiRelease } from "./Release"
import type { ApiArtist } from "./Artist"

export interface ApiTrack {
    id: string
    title: string
    duration_ms: number

    is_favorite: boolean

    artists: ApiArtist[]
    releases: ApiRelease[]
}
