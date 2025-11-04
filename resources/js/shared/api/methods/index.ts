import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { collectionMethods } from "./collection"
import { meMethods } from "./me"
import { playerMethods } from "./player"
import { recentSearchesMethods } from "./recent_searches"
import { releasesMethods } from "./releases"
import { searchMethods } from "./search"
import { trackMethods } from "./tracks"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    collection: collectionMethods,
    me: meMethods,
    player: playerMethods,
    recent_searches: recentSearchesMethods,
    releases: releasesMethods,
    search: searchMethods,
    tracks: trackMethods,
}
