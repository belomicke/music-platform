interface ArtistImage {
    url: string
    width: number
    height: number
}

export interface IArtist {
    id: string
    name: string
    followers: {
        total: number
    }
    images: ArtistImage[]
}
