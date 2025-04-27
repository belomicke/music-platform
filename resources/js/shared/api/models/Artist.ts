export interface ApiCompactArtist {
    id: string
    name: string
    image_url: string
}

export interface ApiArtist extends ApiCompactArtist {
    followers: {
        total: number
        status: boolean
    }
}
