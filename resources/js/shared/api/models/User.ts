export interface ApiUser {
    id: string
    name: string
    followed_artists_count: number
}

export interface ApiCurrentUser extends ApiUser {
    email: string
}
