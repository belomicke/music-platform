import { artistsMethods } from "./artists"
import { authMethods } from "./auth"
import { collectionMethods } from "./collection"
import { meMethods } from "./me"
import { recentSearchesMethods } from "./recent_searches"
import { releasesMethods } from "./releases"
import { searchMethods } from "./search"

export const api = {
    artists: artistsMethods,
    auth: authMethods,
    collection: collectionMethods,
    me: meMethods,
    recent_searches: recentSearchesMethods,
    releases: releasesMethods,
    search: searchMethods,
}
