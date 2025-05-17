import { ApiCompactArtist, ApiRelease } from "@/shared/api"

export type SearchType = "all" | "artists"

export type RecentSearchType = "artist" | "release"

export interface ApiRecentSearch {
    data: ApiRelease | ApiCompactArtist
    type: RecentSearchType
}
