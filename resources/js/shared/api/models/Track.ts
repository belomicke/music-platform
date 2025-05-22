import type { ApiRelease } from "./Release"
import type { ApiCompactArtist } from "./Artist"

export interface ApiTrack {
    id: string
    title: string
    duration_ms: number

    is_favorite: boolean

    artists: ApiCompactArtist[]
    releases: ApiRelease[]
}
