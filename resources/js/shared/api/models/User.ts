export interface ApiCurrentUser {
    id: string
    name: string
    image_url: string

    email: string

    favorite_tracks_count: number
    favorite_artists_count: number
    favorite_releases_count: number
}
