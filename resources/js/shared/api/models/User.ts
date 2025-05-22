export interface ApiCurrentUser {
    id: string
    name: string
    image_url: string

    email: string

    followed_artists_count: number
    followed_users_count: number
    favorite_tracks_count: number
}
