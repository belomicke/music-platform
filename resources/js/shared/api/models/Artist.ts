export interface ApiCompactArtist {
    id: string
    name: string
    image_url: string
    is_followed: boolean
}

export interface ApiArtist extends ApiCompactArtist {
    followers_count: number
}
