import type { ApiCompactArtist } from "./Artist"

export interface ApiRelease {
    id: string
    title: string
    image_url: string
    track_count: number
    like_count: number
    release_date: string

    is_followed: boolean

    artists: ApiCompactArtist[]

    type: "album" | "single"
}
