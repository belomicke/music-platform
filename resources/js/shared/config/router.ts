export type ROUTE_NAME =
    "home"
    | "search"
    | "collection"

    | "sign-in"
    | "sign-up"
    | "reset-password"
    | "forgot-password"

    | "favorite-artists"
    | "favorite-releases"

    | "artist-info"
    | "artist-releases"

    | "release-info"

export const ROUTE_NAMES = {
    HOME: "home",
    SEARCH: "search",
    COLLECTION: "collection",

    SIGN_IN: "sign-in",
    SIGN_UP: "sign-up",
    RESET_PASSWORD: "reset-password",
    FORGOT_PASSWORD: "forgot-password",

    FAVORITE_ARTISTS_PAGE: "favorite-artists",
    FAVORITE_RELEASES_PAGE: "favorite-releases",
    FAVORITE_TRACKS_PAGE: "favorite-tracks",

    ARTIST_INFO_PAGE: "artist-info",
    ARTIST_RELEASES_PAGE: "artist-releases",

    RELEASE_INFO_PAGE: "release-info",
}

export const ROUTE_NAMES_ONLY_FOR_GUESTS = [
    "sign-in",
    "sign-up",
    "reset-password",
    "forgot-password",
]
