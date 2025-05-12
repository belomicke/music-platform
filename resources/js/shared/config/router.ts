export type ROUTE_NAME =
    "home"
    | "search"
    | "collection"

    | "sign-in"
    | "sign-up"
    | "reset-password"
    | "forgot-password"

    | "favourite-artists"

    | "artist-info"

export const ROUTE_NAMES = {
    HOME: "home",
    SEARCH: "search",
    COLLECTION: "collection",

    SIGN_IN: "sign-in",
    SIGN_UP: "sign-up",
    RESET_PASSWORD: "reset-password",
    FORGOT_PASSWORD: "forgot-password",

    FAVOURITE_ARTISTS_PAGE: "favourite-artists",

    ARTIST_INFO_PAGE: "artist-info",
}

export const ROUTE_NAMES_ONLY_FOR_GUESTS = [
    "sign-in",
    "sign-up",
    "reset-password",
    "forgot-password",
]
