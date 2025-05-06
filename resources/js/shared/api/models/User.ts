export interface ApiCompactUser {
    id: string
    name: string
    image_url: string

    is_followed: boolean
}

export interface ApiUser extends ApiCompactUser {
    followed_artists_count: number
    followed_users_count: number
    followers_count: number
}

export interface ApiCurrentUser extends ApiUser {
    email: string
}
